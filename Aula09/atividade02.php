<?php
// Array fornecido
$pastas = array(
    "bsn" => array(
        "3a Fase" => array(
            "desenvWeb" => array(
                "bancoDados 1",
                "engSoft 1"
            )
        ),
        "4a Fase" => array(
            "Intro Web",
            "bancoDados 2",
            "engSoft 2"
        )
    )
);

// Função recursiva para exibir a árvore
function exibirArvore($array, $nivel = 0) {
    foreach ($array as $chave => $valor) {
        echo str_repeat("-", $nivel * 2) . " " . (is_array($valor) ? $chave : $valor) . "<br>";
        if (is_array($valor)) {
            exibirArvore($valor, $nivel + 1);
        }
    }
}

// Chamar a função para exibir a árvore
exibirArvore($pastas);
?>
