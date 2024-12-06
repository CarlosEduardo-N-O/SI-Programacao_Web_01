<?php
// Inicia a sessão
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['login']) || !isset($_SESSION['inicio_sessao'])) {
    header('Location: login.php'); // Redireciona para a página de login, se não estiver logado
    exit();
}

// Atualiza a última requisição
$_SESSION['ultima_requisicao'] = date("Y-m-d H:i:s");

// Calcula o tempo de sessão (em segundos)
$tempoSessao = strtotime($_SESSION['ultima_requisicao']) - strtotime($_SESSION['inicio_sessao']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['login']); ?>!</h1>
    <p><strong>Login:</strong> <?php echo htmlspecialchars($_SESSION['login']); ?></p>
    <p><strong>Senha:</strong> <?php echo htmlspecialchars($_SESSION['senha']); ?></p>
    <p><strong>Data/Hora do Início da Sessão:</strong> <?php echo $_SESSION['inicio_sessao']; ?></p>
    <p><strong>Data/Hora da Última Requisição:</strong> <?php echo $_SESSION['ultima_requisicao']; ?></p>
    <p><strong>Tempo de Sessão (em segundos):</strong> <?php echo $tempoSessao; ?></p>
    <p><a href="login.php">Sair</a></p>
</body>
</html>
