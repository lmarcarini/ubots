<?php

require_once("MyPDO.php");
require_once("Database.php")

$pdo=new Database();

$searchid = '1';
$query=$pdo->prepare('SELECT Titulo FROM Filmes WHERE id = ?');
$query->execute([$searchid]);
$movie=$query->fetch();

echo json_encode($movie);

?>