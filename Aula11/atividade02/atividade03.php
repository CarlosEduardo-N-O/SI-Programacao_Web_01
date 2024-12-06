<?php
include("../atividade01.php");

if($dbcon) {
    $result = pg_query($dbcon,"SELECT * FROM TBPESSOA");

    while($row = pg_fetch_assoc($result)){
        echo "<br>Result: ".print_r($row);
    }
}else{
    echo "Não conectado";
}