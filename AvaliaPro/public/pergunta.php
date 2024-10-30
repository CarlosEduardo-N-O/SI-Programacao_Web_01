<?php
include "../src/header.php";

// Busca as perguntas no banco de dados
$stmt = $pdo->query("SELECT p.id_pergunta, p.pergunta, p.status, s.nome AS setor FROM pergunta p JOIN setor s ON p.id_setor = s.id_setor");
$perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perguntas</title>
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
        <h1>Perguntas</h1>
        <a href="pergunta_add.php" class="btn btn-primary btn-add">Adicionar Pergunta</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Setor</th>
                    <th>Pergunta</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($perguntas as $pergunta): ?>
                <tr>
                    <td><?php echo $pergunta['id_pergunta']; ?></td>
                    <td><?php echo $pergunta['setor']; ?></td>
                    <td><?php echo $pergunta['pergunta']; ?></td>
                    <td><?php echo ($pergunta['status'] == 1) ? 'Ativo' : 'Desativado'; ?></td>
                    <td>
                        <a href="pergunta_edit.php?id=<?php echo $pergunta['id_pergunta']; ?>" class="btn btn-warning">Editar</a>
                        <a href="pergunta_delete.php?id=<?php echo $pergunta['id_pergunta']; ?>" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include "../src/footer.php"; ?>
</body>
</html>
