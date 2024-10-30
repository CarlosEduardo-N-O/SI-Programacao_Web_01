<?php
// resposta_espera.php

// Inicia a sessão
session_start();
include "../config.php"; // Inclua o arquivo de configuração para o banco de dados

// Verifica se a sessão possui os valores necessários
if (!isset($_SESSION['id_dispositivo']) || !isset($_SESSION['id_setor'])) {
    header("Location: resposta_dispositivo.php");
    exit();
}

// Obtém o id do dispositivo e setor da sessão
$id_dispositivo = $_SESSION['id_dispositivo'];
$id_setor = $_SESSION['id_setor'];

// Verifica se há perguntas ativas para o setor atual
$stmt = $pdo->prepare("SELECT COUNT(*) FROM pergunta WHERE id_setor = ? AND status = true");
$stmt->execute([$id_setor]);
$total_perguntas = $stmt->fetchColumn();
$sem_perguntas = $total_perguntas == 0;

// Cria um novo registro na tabela `avaliacao` quando o botão "Avaliar" é pressionado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$sem_perguntas) {
    $stmt = $pdo->prepare("INSERT INTO avaliacao (id_setor, inclusao, id_dispositivo) VALUES (?, NOW(), ?)");
    $stmt->execute([$id_setor, $id_dispositivo]);

    // Armazena o id da avaliação na sessão
    $_SESSION['id_avaliacao'] = $pdo->lastInsertId();

    // Zera o índice da pergunta
    $_SESSION['indice_pergunta'] = 0;

    // Redireciona para resposta_add.php
    header("Location: resposta_add.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/img/logo.png" type="image/x-icon">
    <title>Aguardando Participação</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        .message-container {
            margin-bottom: 30px;
        }
        .btn-evaluate {
            font-size: 24px;
            padding: 15px 30px;
            width: 250px;
        }
        .btn-exit {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }
        .no-questions {
            font-size: 24px;
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php if ($sem_perguntas): ?>
        <div class="no-questions">
            <h1>Este setor não possui perguntas no momento.</h1>
        </div>
    <?php else: ?>
        <div class="message-container">
            <h1>Participe da Nossa Pesquisa!</h1>
            <p>Estamos sempre buscando melhorar. Sua opinião é muito importante para nós!</p>
        </div>

        <form action="" method="POST">
            <button type="submit" class="btn btn-primary btn-evaluate">Avaliar</button>
        </form>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary btn-exit">Sair</a>
</body>
</html>
