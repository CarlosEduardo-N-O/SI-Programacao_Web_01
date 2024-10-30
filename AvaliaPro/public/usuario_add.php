<?php
include "../src/header.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Prepara a consulta de inserção
    $stmt = $pdo->prepare("INSERT INTO usuario (usuario, senha) VALUES (:usuario, :senha)");

    // Executa a consulta
    $stmt->execute([
        ':usuario' => $usuario,
        ':senha' => password_hash($senha, PASSWORD_DEFAULT) // Armazena a senha de forma segura
    ]);

    // Redireciona para a página de listagem após adicionar
    header("Location: usuario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuário</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 95%; /* Aumenta a largura do container */
            padding: 0; /* Remove o padding do container */
        }
        h1 {
            text-align: center; /* Centraliza o título */
            margin: 20px 0; /* Espaçamento em cima e embaixo */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Adicionar Usuário</h1>
        <form method="POST">
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
    </div>
    <?php include "../src/footer.php"; ?>
</body>
</html>
