<?php
include "../src/header.php";

// Função para contar registros em uma tabela específica
function contarRegistros($pdo, $tabela)
{
    $stmt = $pdo->query("SELECT COUNT(*) AS total FROM $tabela");
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado['total'];
}

// Estatísticas com média e total de perguntas
function obterEstatisticasComMediaEPerguntas($pdo)
{
    $stmt = $pdo->query("
        SELECT s.nome AS setor,
               COUNT(r.id_resposta) AS total_respostas,
               COUNT(DISTINCT p.id_pergunta) AS total_perguntas,
               COALESCE(AVG(r.resposta), 0) AS media_respostas
        FROM setor s
        LEFT JOIN dispositivo d ON s.id_setor = d.id_setor
        LEFT JOIN resposta r ON r.id_dispositivo = d.id_dispositivo
        LEFT JOIN pergunta p ON p.id_setor = s.id_setor
        GROUP BY s.nome
        ORDER BY total_respostas DESC
    ");
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Não é necessário recalcular a média, pois já está na consulta SQL
    return $resultados;
}




// Obtem totais
$totalSetores = contarRegistros($pdo, 'setor');
$totalDispositivos = contarRegistros($pdo, 'dispositivo');
$totalPerguntas = contarRegistros($pdo, 'pergunta');
$totalRespostas = contarRegistros($pdo, 'resposta');

// Obtem estatísticas com média e total de perguntas
$estatisticas = obterEstatisticasComMediaEPerguntas($pdo);
$nomesSetores = array_column($estatisticas, 'setor');
$mediaRespostas = array_column($estatisticas, 'media_respostas');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - AvaliaPro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 95%;
            padding: 20px;
        }

        h1,
        h2 {
            text-align: center;
            margin: 20px 0;
        }

        .summary {
            display: flex;
            justify-content: space-around;
            margin-bottom: 30px;
        }

        .summary-item {
            text-align: center;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: #f9f9f9;
            width: 22%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        <h1>Dashboard - AvaliaPro</h1>
        <h2>Resumo Geral</h2>

        <div class="summary">
            <div class="summary-item">
                <h4>Total de Setores</h4>
                <p><?php echo $totalSetores; ?></p>
            </div>
            <div class="summary-item">
                <h4>Total de Dispositivos</h4>
                <p><?php echo $totalDispositivos; ?></p>
            </div>
            <div class="summary-item">
                <h4>Total de Perguntas</h4>
                <p><?php echo $totalPerguntas; ?></p>
            </div>
            <div class="summary-item">
                <h4>Total de Respostas</h4>
                <p><?php echo $totalRespostas; ?></p>
            </div>
        </div>

        <h2>Estatísticas por Setor</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Setor</th>
                    <th>Total de Respostas</th>
                    <th>Total de Perguntas</th>
                    <th>Média de Respostas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estatisticas as $estatistica): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($estatistica['setor']); ?></td>
                        <td><?php echo $estatistica['total_respostas']; ?></td>
                        <td><?php echo $estatistica['total_perguntas']; ?></td>
                        <td><?php echo number_format($estatistica['media_respostas'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Gráfico de Média de Respostas por Setor -->
        <h2>Média de Respostas por Setor</h2>
        <canvas id="graficoMediaRespostas" width="100%" height="40"></canvas>
    </div>

    <script>
        // Dados para o gráfico
        const ctx = document.getElementById('graficoMediaRespostas').getContext('2d');
        const graficoMediaRespostas = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nomesSetores); ?>,
                datasets: [{
                    label: 'Média de Respostas',
                    data: <?php echo json_encode($mediaRespostas); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Média de Respostas'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Setores'
                        }
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Média de Respostas por Setor'
                    }
                }
            }
        });
    </script>

    <?php include "../src/footer.php"; ?>
</body>

</html>