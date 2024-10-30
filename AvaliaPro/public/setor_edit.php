<?php
include "../src/header.php";

$id = $_GET['id'];

// Busca o setor no banco de dados
$stmt = $pdo->prepare("SELECT * FROM setor WHERE id_setor = :id");
$stmt->execute(['id' => $id]);
$setor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$setor) {
    header("Location: setor.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];

    // Atualiza o setor no banco de dados
    $stmt = $pdo->prepare("UPDATE setor SET nome = :nome WHERE id_setor = :id");
    $stmt->execute(['nome' => $nome, 'id' => $id]);

    header("Location: setor.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Setor</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Editar Setor</h1>
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome do Setor:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $setor['nome']; ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Salvar</button>
            <a href="setor.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
<?php
include "../src/footer.php";
?>