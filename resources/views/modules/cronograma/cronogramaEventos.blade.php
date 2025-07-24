<?php
header('Contert-Type: application/json');

$pdo = new PDO("mysql:dbname=db_sadescom;host=127.0.0.1", "root", "");


$sentenciaSQL = $pdo -> prepare("SELECT*FROM cronogramas");
$sentenciaSQL -> execute();

$resultado = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);
echo json_encode($resultado);
