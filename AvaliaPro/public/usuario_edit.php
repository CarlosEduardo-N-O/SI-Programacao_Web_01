<?php
include "../src/header.php";

$id_usuario = $_GET['id'];

// Busca o usuário no banco de dados
$stmt = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :id");
$stmt->execute(['id' => $id_usuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o usuário foi encontrado
if (!$usuario) {
    echo "Usuário não encontrado!";
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_nome = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Prepara a consulta de atualização
    $stmt = $pdo->prepare("UPDATE usuario SET usuario = :usuario, senha = :senha WHERE id_usuario = :id");

    // Executa a consulta
    $stmt->execute([
        ':usuario' => $usuario_nome,
        ':senha' => password_hash($senha, PASSWORD_DEFAULT), // Armazena a senha de forma segura
        ':id' => $id_usuario
    ]);

    // Redireciona para a página de listagem após editar
    header("Location: usuario.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>
        <form method="POST">
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario['usuario']; ?>" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    <?php include "../src/footer.php"; ?>
</body>
</html>
