<?php
include "../src/header.php";

$id = $_GET['id'];

// Exclui o setor do banco de dados
$stmt = $pdo->prepare("DELETE FROM setor WHERE id_setor = :id");
$stmt->execute(['id' => $id]);

header("Location: setor.php");
exit();
?>
