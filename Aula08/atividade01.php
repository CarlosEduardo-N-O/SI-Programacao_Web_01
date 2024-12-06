<?php
// Declaração das constantes
define('NOME', 'Carlos Eduardo');
define('SOBRENOME', 'Nogueira de Oliveira');

// Declaração da variável NOME, concatenando as constantes
$nome_completo = NOME . " " . SOBRENOME;

// Produzindo a saída com o conteúdo
echo $nome_completo;
?>