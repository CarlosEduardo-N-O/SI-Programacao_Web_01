<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/img/logo.png" type="image/x-icon">
    <title>Página Inicial</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            justify-content: center;
            align-items: center;
            margin: 0;
            background-color: #f8f9fa;
        }
        .btn-start {
            font-size: 24px;
            padding: 20px 40px;
        }
        .btn-login {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <a href="login.php" class="btn btn-secondary btn-login">Logar</a>
    <h1 class="mb-5">Bem-vindo ao Sistema de Avaliação</h1>
    <a href="resposta_dispositivo.php" class="btn btn-primary btn-start">Iniciar Avaliação</a>
</body>
</html>
