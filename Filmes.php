<?php

class Filmes{

    private $conection;

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

    public function avaliaFilme(){
        $filme_id=$_GET['filmeId'];
        $user_id=$_GET['userId'];
        $score=$_GET['score'];
        $sql='SELECT id FROM Avaliacoes WHERE userId=? AND filmeId= ?';
        $query=$this->conection->prepare($sql);
        $query->execute([$user_id,$filme_id]);
        $result=$query->fetch();
        if(!$result) {
            $sql='INSERT INTO Avaliacoes (userId, filmeId, avaliacao) VALUES (?,?,?)';
            $query=$this->conection->prepare($sql);
            return $query->execute([$user_id,$filme_id,$score]);
        }
        $id=$result['id'];
        $sql='UPDATE Avaliacoes SET userId= ? , filmeId = ? , avaliacao= ? WHERE id=?';
        $query=$this->conection->prepare($sql);
        return $query->execute([$user_id,$filme_id,$score,$id]);
    }

    public function sugereFilme(){
        $user_id=1;//$_GET['userId'];
        $sql='SELECT * FROM Filmes WHERE id NOT IN (SELECT filmeId FROM Avaliacoes WHERE userId = ?)';
        $query=$this->conection->prepare($sql);
        $query->execute([$user_id]);
        return $query;
    }
}


?>