<?php
// Declaração do ARRAY com os nomes das disciplinas
$disciplinas = array("Lógica Matemática", "Banco de Dados II", "Administração de Sistemas de Informação", "Programação Web I", "Estrutura de Dados II");

// Declaração do ARRAY com os nomes dos professores
$professores = array("Prof. Emanuela", "Prof. Marco", "Prof. Sandro", "Prof. Cleber", "Prof. Fernando");

// Loop for para 5 iterações
for ($i = 0; $i < 5; $i++) {
    // Exibe a disciplina e o professor correspondentes
    echo "Disciplina: " . $disciplinas[$i] . ", professor: " . $professores[$i] . ".<br>";
}
?>

<br>
<br>

<?php
// Declaração do ARRAY associativo com disciplinas e professores
$DisProf = array(
    "Lógica Matemática" => "Prof. Emanuela",
    "Banco de Dados II" => "Prof. Marco",
    "Administração de Sistemas de Informação" => "Prof. Sandro",
    "Programação Web I" => "Prof. Cleber",
    "Estrutura de Dados II" => "Prof. Fernando"
);

// Usando foreach para iterar pelo array associativo
foreach ($DisProf as $disciplina => $professor) {
    echo "Disciplina: " . $disciplina . ", professor: " . $professor . ".<br>";
}
?>