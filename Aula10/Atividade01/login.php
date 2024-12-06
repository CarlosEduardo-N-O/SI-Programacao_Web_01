<?php
// Inicia a sessão
session_start();

// Processa o login ao enviar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['login'] = $_POST['login'] ?? '';
    $_SESSION['senha'] = $_POST['senha'] ?? '';
    $_SESSION['inicio_sessao'] = date("Y-m-d H:i:s"); // Armazena a data/hora do login

    // Redireciona para a página inicial
    header('Location: pagina_inicial.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="post" action="">
        <label for="login">Login:</label>
        <input id="login" type="text" name="login" required><br><br>
        
        <label for="senha">Senha:</label>
        <input id="senha" type="password" name="senha" required><br><br>
        
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
