<?php

require_once("MyPDO.php");

try{
    $pdo=new MyPDO();
}catch(\PDOException $e){
    throw new \PDOException($e->getMessage(),(int)$e->getCode());
}

$deleteId = '1';
$query=$pdo->prepare('DELETE FROM Filmes WHERE id = ?');
$query->execute([$deleteId]);

echo "Exclusão bem sucedida!";

?>