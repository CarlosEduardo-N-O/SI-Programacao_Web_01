<?php
include "../src/header.php";

// Busca os usuários no banco de dados
$stmt = $pdo->query("SELECT * FROM usuario");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
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
        <h1>Usuários</h1>
        <a href="usuario_add.php" class="btn btn-primary btn-add">Adicionar Usuário</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['id_usuario']; ?></td>
                    <td><?php echo $usuario['usuario']; ?></td>
                    <td>
                        <a href="usuario_edit.php?id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-warning">Editar</a>
                        <a href="usuario_delete.php?id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include "../src/footer.php"; ?>
</body>
</html>
