<?php
include "../atividade01.php";
$aDados = array(
    $_POST['campo_primeiro_nome'],
    $_POST['campo_sobrenome'],
    $_POST['campo_email'],
    $_POST['campo_password'],
    $_POST['campo_cidade'],
    $_POST['campo_estado']);

/* Etapa 3 - Fazer a query de inserção dos dados (DML) com o array de valores */
$result = pg_query_params($dbcon, "INSERT INTO TBPESSOA
    (PESNOME, PESSOBRENOME, PESEMAIL, PESPASSWORD, PESCIDADE, PESESTADO)
    VALUES 
    ($1, $2, $3, $4, $5, $6)",
    $aDados);
