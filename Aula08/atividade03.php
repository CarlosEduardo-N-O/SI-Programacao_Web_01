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

// Exibir os valores de SALARIO1 e SALARIO2
echo "Valor Salário 1: $SALARIO1 e Valor Salário 2: $SALARIO2<br>";

// Condicional para verificar qual valor é maior, menor ou se são iguais
if ($SALARIO1 > $SALARIO2) {
    echo "O Valor da variável 1 é maior que o valor da variável 2";
} elseif ($SALARIO1 < $SALARIO2) {
    echo "O Valor da variável 1 é menor que o valor da variável 2";
} else {
    echo "Os valores são iguais";
}
?>
