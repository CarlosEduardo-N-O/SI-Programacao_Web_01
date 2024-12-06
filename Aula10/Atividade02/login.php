<?php
// Inicia a sessão
session_start();

// Processa o login ao enviar o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Armazena os dados na sessão
    $_SESSION['usuario'] = $_POST['login'] ?? '';  // Armazena o login como 'usuario'
    $_SESSION['senha'] = $_POST['senha'] ?? '';  // Armazena a senha
    $_SESSION['started'] = time();  // Armazena o tempo de início da sessão

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
