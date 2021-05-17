<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("Database.php");
require_once("Filmes.php");

$db=new Database();
$pdo=$db->getConection();

$filmes=new Filmes($pdo);
$stmt=$filmes->sugereFilme();
$unwatched=$stmt->fetchAll(PDO::FETCH_ASSOC);
$chosen=array_rand($unwatched,1);
echo json_encode($unwatched[$chosen]);
?>