<?php

class Filmes{

    private $conection;
    private $dbTable = "Filmes";

    public function __construct($pdo){
        $this->conection = $pdo;
    }
    
    public function getFilmes(){
        $sql='SELECT Titulo FROM Filmes';
        $query=$this->conection->prepare($sql);
        $query->execute();
        return $query;
    }

    public function insereFilme(){
        $titulo=$_GET['titulo'];
        $ano=$_GET["ano"];
        $imdb=$_GET["imdb"];
        $sql='INSERT INTO Filmes (Titulo, Ano, imdb) VALUES (?,?,?)';
        $query=$this->conection->prepare($sql);
        return $query->execute([$titulo,$ano,$imdb]);
    }

    public function updateFilme(){
        $id=$_GET['id'];
        $titulo=$_GET['titulo'];
        $ano=$_GET["ano"];
        $imdb=$_GET["imdb"];
        $sql='UPDATE Filmes SET Titulo= ? , Ano= ? , imdb= ? WHERE id=?';
        $query=$this->conection->prepare($sql);
        return $query->execute([$titulo,$ano,$imdb,$id]);
    }

    public function deletaFilme(){
        $id=$_GET['id'];
        $sql='DELETE FROM Filmes WHERE id = ?';
        $query=$this->conection->prepare($sql);
        return $query->execute([$id]);
    }
}


?>