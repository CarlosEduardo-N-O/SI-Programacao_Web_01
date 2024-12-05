<?php
include "../config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    $stmt = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario");
    $stmt->execute(['usuario' => $usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifique se o usuário existe e se a senha está correta
    if ($user && password_verify($senha, $user['senha'])) {
        session_start(); 
        $_SESSION['id_usuario'] = $user['id_usuario'];
        header("Location: dashboard.php");
        exit();
    } else {
        $erro = "Usuário ou senha inválidos."; // Mensagem genérica
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/img/logo.png" type="image/x-icon">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            align-items: center; /* Centraliza verticalmente */
            justify-content: center; /* Centraliza horizontalmente */
            margin: 0;
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 100%;
            height: auto;
            width: 300px; /* Ajusta a largura da logo */
            border-radius: 10px;
        }
        .btn-back {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="../src/img/logo.png" alt="Logo do Sistema"> <!-- Corrigido -->
        </div>
        <h1 class="text-center">Login</h1>
        <form method="POST" action="">
            <?php if (isset($erro)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($erro); ?> <!-- Sanitização -->
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="usuario">Usuário:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
        </form>
        <a href="index.php" class="btn btn-secondary btn-block btn-back">Voltar à Avaliação</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
