<?php

require_once("Database.php");

$db=new Database();
$pdo=$db->getConection();

$titulo="Tenet";
$ano="2020";
$imdb="6723592";
$query=$pdo->prepare('INSERT INTO Filmes (Titulo, Ano, imdb) VALUES (?,?,?)');
$query->execute([$titulo,$ano,$imdb]);
$movie=$query->fetch();

echo json_encode($movie);

?>