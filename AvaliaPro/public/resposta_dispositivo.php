<?php
session_start(); // Inicia a sessão
include "../config.php";

// Busca apenas os dispositivos ativos e seus setores no banco de dados
$stmt = $pdo->query("
    SELECT d.id_dispositivo, d.nome AS nome_dispositivo, s.id_setor, s.nome AS nome_setor 
    FROM dispositivo d 
    JOIN setor s ON d.id_setor = s.id_setor 
    WHERE d.status = true
");
$dispositivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../src/img/logo.png" type="image/x-icon">
    <title>Selecionar Dispositivo</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh; /* Ocupa 100% da altura da tela */
            display: flex;
            justify-content: center; /* Centraliza horizontalmente */
            align-items: center; /* Centraliza verticalmente */
            margin: 0; /* Remove margens do body */
        }
        .container {
            width: 90%; /* Aumenta a largura do contêiner */
            max-width: 600px; /* Largura máxima */
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 40px; /* Aumenta o padding */
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        @media (max-width: 576px) { /* Estilo para telas menores */
            .container {
                width: 90%; /* O contêiner ocupará 90% da largura da tela em dispositivos móveis */
                padding: 20px; /* Reduz o padding em dispositivos móveis */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selecionar Dispositivo</h1>
        <p class="text-center">Escolha um dispositivo para iniciar a avaliação:</p>
        <form action="" method="POST"> <!-- O formulário envia para o mesmo arquivo -->
            <div class="form-group">
                <label for="id_dispositivo">Dispositivo:</label>
                <select class="form-control" id="id_dispositivo" name="id_dispositivo" required>
                    <option value="">Selecione um dispositivo</option>
                    <?php foreach ($dispositivos as $dispositivo): ?>
                        <option value="<?php echo $dispositivo['id_dispositivo']; ?>" data-setor="<?php echo $dispositivo['id_setor']; ?>">
                            <?php echo $dispositivo['nome_dispositivo'] . ' - ' . $dispositivo['nome_setor']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Iniciar Avaliação</button>
        </form>
        <br>
        <a href="index.php" class="btn btn-secondary btn-block">Voltar</a>
    </div>

    <?php
    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém o id do dispositivo e o setor
        $id_dispositivo = $_POST['id_dispositivo'];
        $id_setor = $_POST['id_setor'];

        // Armazena na sessão
        $_SESSION['id_dispositivo'] = $id_dispositivo;
        $_SESSION['id_setor'] = $id_setor;

        // Redireciona para resposta_add.php
        header("Location: resposta_espera.php");
        exit(); // Encerra o script para evitar execução adicional
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Script para redirecionar com id_setor
        $('form').on('submit', function(event) {
            var id_setor = $(this).find('select[name="id_dispositivo"] option:selected').data('setor');
            // Cria um campo oculto para enviar o id_setor
            $('<input>').attr({
                type: 'hidden',
                name: 'id_setor',
                value: id_setor
            }).appendTo(this);
        });
    </script>
</body>
</html>
