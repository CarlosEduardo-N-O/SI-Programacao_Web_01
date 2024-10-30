<?php
include "../src/header.php";

$id_dispositivo = $_GET['id'];

// Busca o dispositivo no banco de dados
$stmt = $pdo->prepare("SELECT * FROM dispositivo WHERE id_dispositivo = :id");
$stmt->execute(['id' => $id_dispositivo]);
$dispositivo = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o dispositivo foi encontrado
if (!$dispositivo) {
    echo "Dispositivo não encontrado!";
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $id_setor = $_POST['id_setor'];
    // Converte o valor do status para booleano
    $status = ($_POST['status'] === 'Ativo') ? 1 : 0;

    // Prepara a consulta de atualização
    $stmt = $pdo->prepare("UPDATE dispositivo SET nome = :nome, id_setor = :id_setor, status = :status WHERE id_dispositivo = :id");

    // Executa a consulta
    $stmt->execute([
        ':nome' => $nome,
        ':id_setor' => $id_setor,
        ':status' => $status,
        ':id' => $id_dispositivo
    ]);

    // Redireciona para a página de listagem após editar
    header("Location: dispositivo.php");
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
    <title>Editar Dispositivo</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Editar Dispositivo</h1>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome do Dispositivo</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $dispositivo['nome']; ?>" required>
            </div>
            <div class="form-group">
                <label for="id_setor">Setor</label>
                <select class="form-control" id="id_setor" name="id_setor" required>
                    <?php foreach ($setores as $setor): ?>
                        <option value="<?php echo $setor['id_setor']; ?>" <?php echo ($setor['id_setor'] == $dispositivo['id_setor']) ? 'selected' : ''; ?>>
                            <?php echo $setor['nome']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Ativo" <?php echo ($dispositivo['status'] == 1) ? 'selected' : ''; ?>>Ativo</option>
                    <option value="Inativo" <?php echo ($dispositivo['status'] == 0) ? 'selected' : ''; ?>>Inativo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    <?php include "../src/footer.php"; ?>
</body>
</html>
