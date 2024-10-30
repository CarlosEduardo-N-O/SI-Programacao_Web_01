<?php
session_start();

// Verifique se o usuário não está logado ou se não é do tipo 'administrador'
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

include "../config.php";
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AvaliaPro</title>
    <link rel="icon" href="../src/img/logo.png" type="image/x-icon">

    <!-- Incluindo o CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="dashboard.php">AvaliaPro</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="setor.php">Setores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pergunta.php">Perguntas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="avaliacao.php">Avaliações</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="configDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Configurações
                        </a>
                        <div class="dropdown-menu" aria-labelledby="configDropdown">
                            <a class="dropdown-item" href="usuario.php">Usuários</a>
                            <a class="dropdown-item" href="dispositivo.php">Dispositivos</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</body>
</html>
