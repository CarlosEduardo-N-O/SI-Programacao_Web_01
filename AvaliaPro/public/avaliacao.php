<?php
include "../src/header.php"; // Inclua seu cabeçalho, se necessário

// Busca as avaliações no banco de dados
$stmt = $pdo->query("SELECT a.id_avaliacao, a.id_dispositivo, a.id_setor, a.inclusao, d.nome AS nome_dispositivo, s.nome AS nome_setor
                      FROM avaliacao a
                      JOIN dispositivo d ON a.id_dispositivo = d.id_dispositivo
                      JOIN setor s ON a.id_setor = s.id_setor");
$avaliacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliações</title>
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
        .btn-add {
            float: left; /* Posiciona o botão à esquerda */
            margin-bottom: 20px; /* Espaço abaixo do botão */
        }
        table {
            width: 100%; /* A tabela ocupa toda a largura */
            border-collapse: collapse; /* Remove o espaço entre as bordas da tabela */
        }
        th, td {
            text-align: center; /* Centraliza o texto das células */
            padding: 15px; /* Espaçamento dentro das células */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Avaliações</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Dispositivo</th>
                    <th>Setor</th>
                    <th>Data de Inclusão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($avaliacoes as $avaliacao): ?>
                <tr>
                    <td><?php echo $avaliacao['id_avaliacao']; ?></td>
                    <td><?php echo $avaliacao['nome_dispositivo']; ?></td>
                    <td><?php echo $avaliacao['nome_setor']; ?></td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($avaliacao['inclusao'])); ?></td>
                    <td>
                        <a href="avaliacao_view.php?id=<?php echo $avaliacao['id_avaliacao']; ?>" class="btn btn-info">Visualizar</a>
                        <a href="avaliacao_delete.php?id=<?php echo $avaliacao['id_avaliacao']; ?>" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include "../src/footer.php"; // Inclua seu rodapé, se necessário ?>
</body>
</html>
