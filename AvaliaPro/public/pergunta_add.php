<?php
include "../src/header.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pergunta = $_POST['pergunta'];
    $id_setor = $_POST['id_setor'];
    // Converte o valor do status para booleano
    $status = ($_POST['status'] === 'Ativo') ? 1 : 0;

    // Prepara a consulta de inserção
    $stmt = $pdo->prepare("INSERT INTO pergunta (pergunta, id_setor, status) VALUES (:pergunta, :id_setor, :status)");

    // Executa a consulta
    $stmt->execute([
        ':pergunta' => $pergunta,
        ':id_setor' => $id_setor,
        ':status' => $status
    ]);

    // Redireciona para a página de listagem após adicionar
    header("Location: pergunta.php");
    exit();
}

// Busca os setores para exibir no formulário
$stmt_setor = $pdo->query("SELECT id_setor, nome FROM setor");
$setores = $stmt_setor->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Pergunta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Adicionar Pergunta</h1>
        <form method="POST">
            <div class="form-group">
                <label for="pergunta">Pergunta</label>
                <input type="text" class="form-control" id="pergunta" name="pergunta" required>
            </div>
            <div class="form-group">
                <label for="id_setor">Setor</label>
                <select class="form-control" id="id_setor" name="id_setor" required>
                    <?php foreach ($setores as $setor): ?>
                        <option value="<?php echo $setor['id_setor']; ?>"><?php echo $setor['nome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Ativo">Ativo</option>
                    <option value="Inativo">Inativo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
    </div>
    <?php include "../src/footer.php"; ?>
</body>
</html>
