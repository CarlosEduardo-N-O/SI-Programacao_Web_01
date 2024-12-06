<?php
// Declaração das variáveis
$SALARIO1 = 1000;
$SALARIO2 = 2000;

// Atribuir o valor de SALARIO1 para SALARIO2
$SALARIO2 = $SALARIO1;

// Incrementar 1 na variável SALARIO2
$SALARIO2++;

// Adicionar 10% de aumento para SALARIO1
$SALARIO1 += $SALARIO1 * 0.10;

// Exibir os valores de SALARIO1 e SALARIO2 antes do loop
echo "Valor Salário 1: $SALARIO1 e Valor Salário 2: $SALARIO2<br>";

// Laço de repetição que será executado 100 vezes
for ($i = 1; $i <= 100; $i++) {
    // Incrementa 1 na variável SALARIO1 a cada iteração
    $SALARIO1++;

    // Verifica se a iteração é a 50, e para o loop se for
    if ($i == 50) {
        echo "Parando o loop na iteração 50.<br>";
        break;
    }
}

// Fora do loop, verifica se SALARIO1 é menor que SALARIO2
if ($SALARIO1 < $SALARIO2) {
    echo "Valor final de Salário 1: $SALARIO1 (menor que Salário 2: $SALARIO2)";
} else {
    echo "Valor final de Salário 1: $SALARIO1";
}
?>
