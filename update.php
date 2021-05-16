<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once("Database.php");
require_once("Filmes.php");

$db=new Database();
$pdo=$db->getConection();

$filmes=new Filmes($pdo);

if($filmes->updateFilme()){
    echo "Informações do filme atualizadas com sucesso!";
}else{
    echo "Não foi possível atualizar as informações!";
}

?>