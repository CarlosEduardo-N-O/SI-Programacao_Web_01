<?php
// resposta_salva.php

// Inicia a sessão, caso necessário
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/img/logo.png" type="image/x-icon">
    <title>Agradecimento</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .message-container {
            text-align: center;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h1>Obrigado pela sua participação!</h1>
        <p>Você será redirecionado em <span id="countdown">5</span> segundos...</p>
    </div>

    <script>
        // Countdown para redirecionamento
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');

        const interval = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;

            if (countdown <= 0) {
                clearInterval(interval);
                window.location.href = 'resposta_espera.php'; // Redireciona após 5 segundos
            }
        }, 1000);
    </script>
</body>
</html>
