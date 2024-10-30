<?php
include "../src/header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];

    // Insere o novo setor no banco de dados
    $stmt = $pdo->prepare("INSERT INTO setor (nome) VALUES (:nome)");
    $stmt->execute(['nome' => $nome]);

    header("Location: setor.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Setor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Adicionar Setor</h1>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome do Setor:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <button type="submit" class="btn btn-success">Adicionar</button>
            <a href="setor.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
<?php
include "../src/footer.php";
?>