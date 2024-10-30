<?php
include "../config.php"; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter dados do formulário
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Hash da senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir o usuário no banco de dados
    $stmt = $pdo->prepare("INSERT INTO usuario (usuario, senha) VALUES (:usuario, :senha)");
    
    // Executar a instrução
    if ($stmt->execute(['usuario' => $usuario, 'senha' => $senha_hash])) {
        echo "Usuário inserido com sucesso!";
    } else {
        echo "Erro ao inserir o usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Usuário</title>
</head>
<body>
    <h1>Inserir Usuário</h1>
    <form method="POST" action="">
        <label>Usuário:</label>
        <input type="text" name="usuario" required>
        <br>
        <label>Senha:</label>
        <input type="password" name="senha" required>
        <br>
        <button type="submit">Inserir</button>
    </form>
</body>
</html>
