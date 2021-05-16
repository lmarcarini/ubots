<?php

require_once("Database.php");

$db=new Database();
$pdo=$db->getConection();

$deleteId = '1';
$query=$pdo->prepare('DELETE FROM Filmes WHERE id = ?');
$query->execute([$deleteId]);

echo "Exclusão bem sucedida!";

?>