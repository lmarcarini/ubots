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
$query=$pdo->prepare('UPDATE Filmes SET Titulo= ? , Ano= ? , imdb= ? WHERE id=2');
$query->execute([$titulo,$ano,$imdb]);

echo json_encode("Mudança bem sucedida!");

?>