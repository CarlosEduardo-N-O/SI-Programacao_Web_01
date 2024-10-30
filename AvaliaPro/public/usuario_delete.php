<?php
include "../src/header.php";

$id_usuario = $_GET['id'];

// Prepara a consulta de exclusão
$stmt = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = :id");
$stmt->execute(['id' => $id_usuario]);

// Redireciona para a página de listagem após excluir
header("Location: usuario.php");
exit();
?>
