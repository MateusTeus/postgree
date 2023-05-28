<?php

$host = "localhost";
$port = "5432";
$dbname = "projetopit";
$user = "postgres";
$password = "123";
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    die("Houve um erro ao conectar com o banco de dados.");
}else{
    echo"ok";
}
?>




