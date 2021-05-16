<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("Database.php");
require_once("Filmes.php");

$db=new Database();
$pdo=$db->getConection();

$filmes=new Filmes($pdo);
$stmt=$filmes->getFilmes();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC))
?>