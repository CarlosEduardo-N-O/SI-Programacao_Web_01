<?php
try{
    $dbcon = pg_connect("host=localhost
                         port=5432
                         dbname=local
                         user=postgres
                         password=postgres");
    
} catch(Exception $e){
    echo $e->getMessage();
}