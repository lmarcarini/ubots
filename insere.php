<?php

require_once("MyPDO.php");

try{
    $pdo=new MyPDO();
}catch(\PDOException $e){
    throw new \PDOException($e->getMessage(),(int)$e->getCode());
}

$titulo="Tenet";
$ano="2020";
$imdb="6723592";
$query=$pdo->prepare('INSERT INTO Filmes (Titulo, Ano, imdb) VALUES (?,?,?)');
$query->execute([$titulo,$ano,$imdb]);
$movie=$query->fetch();

echo json_encode($movie);

?>