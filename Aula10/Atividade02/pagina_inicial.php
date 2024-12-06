<?php
session_start();

// Verifica se os dados de sessão existem
if (!isset($_SESSION['usuario']) || !isset($_SESSION['started'])) {
    echo "<script>alert('Os dados da sessão foram perdidos. Faça login novamente.');</script>";
    echo "<a href='login.php'>Voltar para Login</a>";
    exit;
}

// Atualiza a hora da última requisição
$_SESSION['last_request'] = time();

// Calcula o tempo de sessão
$tempo_sessao = time() - $_SESSION['started'];
$tempo_sessao_formatado = gmdate("H:i:s", $tempo_sessao);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
</head>
<body>
    <h1>Sessão iniciada e usuário registrado.</h1>
    <p>
        Clique aqui para continuar: 
        <a href="pagina_inicial.php">Continuar</a>
    </p>
    <p>
        O seu identificador de sessão é: <b><?php echo session_id(); ?></b>
    </p>
    <p>
        Dados da sessão: <br>
        <b>Usuário:</b> <?php echo $_SESSION['usuario']; ?><br>
        <b>Início:</b> <?php echo date('Y-m-d H:i:s', $_SESSION['started']); ?><br>
        <b>Última Requisição:</b> <?php echo date('Y-m-d H:i:s', $_SESSION['last_request']); ?><br>
        <b>Tempo de Sessão:</b> <?php echo $tempo_sessao_formatado; ?>
    </p>
</body>
</html>
