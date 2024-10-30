<?php
include "../src/header.php";

// Busca os dispositivos no banco de dados
$stmt = $pdo->query("SELECT d.id_dispositivo, d.nome, d.status, s.nome AS setor FROM dispositivo d JOIN setor s ON d.id_setor = s.id_setor");
$dispositivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dispositivos</title>
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
        <h1>Dispositivos</h1>
        <a href="dispositivo_add.php" class="btn btn-primary btn-add">Adicionar Dispositivo</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Setor</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dispositivos as $dispositivo): ?>
                <tr>
                    <td><?php echo $dispositivo['id_dispositivo']; ?></td>
                    <td><?php echo $dispositivo['setor']; ?></td>
                    <td><?php echo $dispositivo['nome']; ?></td>
                    <td><?php echo ($dispositivo['status'] == 1) ? 'Ativo' : 'Inativo'; ?></td>
                    <td>
                        <a href="dispositivo_edit.php?id=<?php echo $dispositivo['id_dispositivo']; ?>" class="btn btn-warning">Editar</a>
                        <a href="dispositivo_delete.php?id=<?php echo $dispositivo['id_dispositivo']; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este dispositivo?');">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include "../src/footer.php"; ?>
</body>
</html>
