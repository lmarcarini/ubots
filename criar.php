<?php

require_once("MyPDO.php");

try{
    $pdo=new MyPDO();
}catch(\PDOException $e){
    throw new \PDOException($e->getMessage(),(int)$e->getCode());
}

$searchid = '1';
$query=$pdo->prepare('SELECT Titulo FROM Filmes WHERE id = ?');
$query->execute([$searchid]);
$movie=$query->fetch();

echo json_encode($movie);

?>