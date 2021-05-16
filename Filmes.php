<?php

class Filmes{

    private $conection;
    private $dbTable = "Filmes";

    public function __construct($pdo){
        $this->conection = $pdo;
    }
    
    public function getFilmes(){
        //$searchid = '2';
        //$query=$this->conection->prepare('SELECT Titulo FROM Filmes WHERE id = ?');
        $query=$this->conection->prepare('SELECT Titulo FROM Filmes');
        $query->execute();
        return $query;
    }

    public function insereFilme(){
        $titulo=$_GET['titulo'];
        $ano=$_GET["ano"];
        $imdb=$_GET["imdb"];
        $query=$this->conection->prepare('INSERT INTO Filmes (Titulo, Ano, imdb) VALUES (?,?,?)');
        return $query->execute([$titulo,$ano,$imdb]);
    }
}


?>