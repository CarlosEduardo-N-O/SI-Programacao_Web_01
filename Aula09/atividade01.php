<?php
// Declarar array com notas
$notas = array(8.5, 7.0, 9.0, 6.5, 8.0);

// Declarar array com faltas (1 representa falta, 0 representa presença)
$faltas = array(0, 1, 0, 0, 1, 0, 0, 1, 0, 0);

// Função para calcular a média das notas
function calcularMedia($notas) {
    $soma = array_sum($notas);
    $quantidade = count($notas);
    if ($quantidade == 0) {
        return 0;
    }
    return $soma / $quantidade;
}

// Função para verificar aprovação por nota
function verificarAprovacaoPorNota($media) {
    if ($media > 7) {
        return "Aprovado por Nota";
    } else {
        return "Reprovado por Nota";
    }
}

// Função para calcular a frequência
function calcularFrequencia($faltas) {
    $totalDias = count($faltas);
    $totalFaltas = array_sum($faltas);
    if ($totalDias == 0) {
        return 0;
    }
    $frequencia = (($totalDias - $totalFaltas) / $totalDias) * 100;
    return $frequencia;
}

// Função para verificar aprovação por frequência
function verificarAprovacaoPorFrequencia($frequencia) {
    if ($frequencia > 70) {
        return "Aprovado por Frequência";
    } else {
        return "Reprovado por Frequência";
    }
}

// Chamadas das funções e exibição dos resultados
$media = calcularMedia($notas);
$statusNota = verificarAprovacaoPorNota($media);
$frequencia = calcularFrequencia($faltas);
$statusFrequencia = verificarAprovacaoPorFrequencia($frequencia);

// Exibindo os resultados
echo "Média das Notas: " . number_format($media, 2) . "<br>";
echo "Status por Nota: " . $statusNota . "<br>";
echo "Frequência: " . number_format($frequencia, 2) . "%<br>";
echo "Status por Frequência: " . $statusFrequencia . "<br>";

// Verificação final de aprovação
if ($statusNota == "Aprovado por Nota" && $statusFrequencia == "Aprovado por Frequência") {
    echo "<strong>Situação Final: Aprovado!</strong>";
} else {
    echo "<strong>Situação Final: Reprovado!</strong>";
}
?>
