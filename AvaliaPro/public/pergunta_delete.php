<?php
include "../src/header.php";

$id = $_GET['id'];

// Exclui a pergunta do banco de dados
$stmt = $pdo->prepare("DELETE FROM pergunta WHERE id_pergunta = :id");
$stmt->execute(['id' => $id]);

// Redireciona para a lista de perguntas
header("Location: pergunta.php");
exit();
?>
