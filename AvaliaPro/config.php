<?php
// Arquivo config.php
$host = 'localhost';
$dbname = 'AvaliaPro';
$user = 'postgres';
$password = 'postgres';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    exit();
}
?>
