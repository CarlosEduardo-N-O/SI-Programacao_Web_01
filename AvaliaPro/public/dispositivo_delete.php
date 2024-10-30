<?php
include "../src/header.php";

$id_dispositivo = $_GET['id'];

// Exclui o dispositivo do banco de dados
$stmt = $pdo->prepare("DELETE FROM dispositivo WHERE id_dispositivo = :id");
$stmt->execute(['id' => $id_dispositivo]);

// Redireciona para a página de listagem após excluir
header("Location: dispositivo.php");
exit();
?>
