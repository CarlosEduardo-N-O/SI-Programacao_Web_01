<?php
include "../src/header.php"; // Inclua seu cabeçalho, se necessário

// Verifica se o ID da avaliação foi passado via GET
if (!isset($_GET['id'])) {
    die("ID da avaliação não fornecido.");
}

$id_avaliacao = $_GET['id'];

// Busca a avaliação específica e suas perguntas e respostas
$stmt = $pdo->prepare("
    SELECT a.id_avaliacao, d.nome AS nome_dispositivo, s.nome AS nome_setor, a.inclusao, 
           p.id_pergunta, p.pergunta, r.resposta, r.descricao 
    FROM avaliacao a
    JOIN dispositivo d ON a.id_dispositivo = d.id_dispositivo
    JOIN setor s ON a.id_setor = s.id_setor
    JOIN pergunta p ON p.id_setor = a.id_setor
    LEFT JOIN resposta r ON r.id_avaliacao = a.id_avaliacao AND r.id_pergunta = p.id_pergunta
    WHERE a.id_avaliacao = :id_avaliacao
");
$stmt->bindParam(':id_avaliacao', $id_avaliacao);
$stmt->execute();
$avaliacao = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se a avaliação existe
if (empty($avaliacao)) {
    die("Avaliação não encontrada.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Avaliação</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 95%;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: center;
            padding: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Visualizar Avaliação</h1>
        <h4>Avaliação de: <?php echo $avaliacao[0]['nome_dispositivo']; ?> - Setor: <?php echo $avaliacao[0]['nome_setor']; ?></h4>
        <h6>Data de Inclusão: <?php echo date('d/m/Y H:i:s', strtotime($avaliacao[0]['inclusao'])); ?></h6>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pergunta</th>
                    <th>Pergunta</th>
                    <th>Resposta</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($avaliacao as $item): ?>
                    <tr>
                        <td><?php echo $item['id_pergunta']; ?></td>
                        <td><?php echo $item['pergunta']; ?></td>
                        <td><?php echo isset($item['resposta']) ? $item['resposta'] : 'Nenhuma resposta'; ?></td>
                        <td><?php echo isset($item['descricao']) ? $item['descricao'] : 'Sem descrição'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="avaliacao.php" class="btn btn-secondary">Voltar</a>
    </div>
    <?php include "../src/footer.php"; // Inclua seu rodapé, se necessário 
    ?>
</body>

</html>