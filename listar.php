<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once("Database.php");
require_once("Filmes.php");

$db=new Database();
$pdo=$db->getConection();

$filmes=new Filmes($pdo);
$stmt=$filmes->getFilmes();

foreach($stmt as $row){
    echo $row['Titulo']."\n";
}

/*
if($noFilmes>0){
    $filmesArr=array();
    $filmesArr["body"]=array();
    $filmesArr["noFilmes"]=$noFilmes;
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e=array(
            "id"=> $id,
            "titulo"=>$titulo,
            "ano"=>$ano,
            "imdb"=>$imdb
        );
        array_push($filmesArr,$e);
    }
    echo json_encode($filmesArr);
}
else{
    http_response(404);
    echo json_encode(
        array("message"=>"Nenhum filme encontrado.")
    );
}
*/

?>