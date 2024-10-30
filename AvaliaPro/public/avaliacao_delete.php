<?php
include "../config.php"; // Inclua seu arquivo de configuração do banco de dados

// Verifica se o ID da avaliação foi passado via GET
if (!isset($_GET['id'])) {
    die("ID da avaliação não fornecido.");
}

$id_avaliacao = $_GET['id'];

// Inicia uma transação
try {
    $pdo->beginTransaction();

    // Exclui as respostas associadas à avaliação
    $stmt = $pdo->prepare("DELETE FROM resposta WHERE id_avaliacao = :id_avaliacao");
    $stmt->bindParam(':id_avaliacao', $id_avaliacao);
    $stmt->execute();

    // Exclui a avaliação
    $stmt = $pdo->prepare("DELETE FROM avaliacao WHERE id_avaliacao = :id_avaliacao");
    $stmt->bindParam(':id_avaliacao', $id_avaliacao);
    $stmt->execute();

    // Se tudo estiver certo, faz o commit
    $pdo->commit();

    echo "<script>alert('Avaliação e suas respostas foram excluídas com sucesso!');</script>";
    echo "<script>window.location.href='avaliacao.php';</script>"; // Redireciona para a página de avaliações
} catch (Exception $e) {
    // Em caso de erro, desfaz a transação
    $pdo->rollBack();
    die("Erro ao excluir a avaliação: " . $e->getMessage());
}
?>
