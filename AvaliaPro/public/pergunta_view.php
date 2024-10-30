<?php
include "../src/header.php";

// Verifica se o ID foi passado pela URL
if (isset($_GET['id'])) {
    $id_pergunta = $_GET['id'];

    // Busca os detalhes da pergunta no banco de dados
    $stmt = $pdo->prepare("SELECT p.id_pergunta, p.pergunta, p.status, s.nome AS setor FROM pergunta p JOIN setor s ON p.id_setor = s.id_setor WHERE p.id_pergunta = ?");
    $stmt->execute([$id_pergunta]);
    $pergunta = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se a pergunta não for encontrada, redireciona de volta para a lista
    if (!$pergunta) {
        header("Location: pergunta.php");
        exit;
    }
} else {
    // Redireciona para a lista se o ID não for passado
    header("Location: pergunta.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Pergunta</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Visualizar Pergunta</h1>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td><?php echo $pergunta['id_pergunta']; ?></td>
            </tr>
            <tr>
                <th>Pergunta</th>
                <td><?php echo $pergunta['pergunta']; ?></td>
            </tr>
            <tr>
                <th>Setor</th>
                <td><?php echo $pergunta['setor']; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo ($pergunta['status'] == 1) ? 'Ativo' : 'Desativado'; ?></td>
            </tr>
        </table>
        <a href="pergunta.php" class="btn btn-primary">Voltar</a>
        <a href="pergunta_edit.php?id=<?php echo $pergunta['id_pergunta']; ?>" class="btn btn-warning">Editar</a>
        <a href="pergunta_delete.php?id=<?php echo $pergunta['id_pergunta']; ?>" class="btn btn-danger">Excluir</a>
    </div>

    <?php include "../src/footer.php"; ?>
</body>
</html>
