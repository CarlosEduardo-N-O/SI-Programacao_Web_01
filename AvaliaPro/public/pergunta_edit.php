<?php
include "../src/header.php";

// Verifica se foi passado um ID pela URL
if (isset($_GET['id'])) {
    $id_pergunta = $_GET['id'];

    // Busca a pergunta no banco de dados com base no ID
    $stmt = $pdo->prepare("SELECT * FROM pergunta WHERE id_pergunta = ?");
    $stmt->execute([$id_pergunta]);
    $pergunta = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se a pergunta não for encontrada, redireciona de volta para a lista
    if (!$pergunta) {
        header("Location: pergunta.php");
        exit;
    }
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pergunta_text = $_POST['pergunta'];
    $status = $_POST['status']; // Recebe o status como "Ativo" ou "Desativado"
    $id_setor = $_POST['id_setor'];

    // Converte o status para booleano (1 para "Ativo", 0 para "Desativado")
    $status_boolean = ($status == 'Ativo') ? 1 : 0;

    // Atualiza a pergunta no banco de dados
    $stmt = $pdo->prepare("UPDATE pergunta SET pergunta = ?, status = ?, id_setor = ? WHERE id_pergunta = ?");
    $stmt->execute([$pergunta_text, $status_boolean, $id_setor, $id_pergunta]);

    // Redireciona de volta para a lista de perguntas
    header("Location: pergunta.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pergunta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Editar Pergunta</h1>
        <form method="POST">
            <div class="form-group">
                <label for="pergunta">Pergunta</label>
                <input type="text" class="form-control" id="pergunta" name="pergunta" value="<?php echo $pergunta['pergunta']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Ativo" <?php echo ($pergunta['status'] == 1) ? 'selected' : ''; ?>>Ativo</option>
                    <option value="Desativado" <?php echo ($pergunta['status'] == 0) ? 'selected' : ''; ?>>Desativado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="id_setor">Setor</label>
                <select class="form-control" id="id_setor" name="id_setor" required>
                    <?php
                    // Busca os setores para o dropdown
                    $stmt_setores = $pdo->query("SELECT id_setor, nome FROM setor");
                    $setores = $stmt_setores->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($setores as $setor) {
                        $selected = ($setor['id_setor'] == $pergunta['id_setor']) ? 'selected' : '';
                        echo "<option value='{$setor['id_setor']}' $selected>{$setor['nome']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="pergunta.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <?php include "../src/footer.php"; ?>
</body>
</html>
