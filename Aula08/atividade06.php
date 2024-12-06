<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>atividade06</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
        }

        th {
            background-color: #60A7C6;
            color: white;
            padding: 8px;
            text-align: left;
        }

        td {
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #d9edf7;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>


    <table>
        <tr>
            <th>Disciplina</th>
            <th>Faltas</th>
            <th>Média</th>
        </tr>

        <?php
        // Declaração de uma matriz multidimensional com os dados
        $dados = array(
            array("Disciplina" => "Matemática", "Faltas" => 5, "Média" => 8.5),
            array("Disciplina" => "Português", "Faltas" => 2, "Média" => 9),
            array("Disciplina" => "Geografia", "Faltas" => 10, "Média" => 6),
            array("Disciplina" => "Educação Física", "Faltas" => 2, "Média" => 8)
        );
        // Percorrendo os elementos da matriz multidimensional e preenchendo a tabela
        foreach ($dados as $disciplina) {
            echo "<tr>";
            echo "<td>" . $disciplina['Disciplina'] . "</td>";
            echo "<td>" . $disciplina['Faltas'] . "</td>";
            echo "<td>" . $disciplina['Média'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>