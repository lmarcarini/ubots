<?php

class Filmes{

    private $conection;

    public function __construct($pdo){
        $this->conection = $pdo;
    }
    
    public function getFilmes(){
        $user_id=isset($_GET['id'])?$_GET['id']:null;
        $offset=isset($_GET['offset'])?$_GET['offset']*4:0;
        if($user_id!=null){
            $sql='SELECT filmes.*, avaliacoes.avaliacao FROM filmes LEFT JOIN avaliacoes ON (filmes.id=avaliacoes.filmeId AND avaliacoes.userId= ? ) LIMIT ?, 4';
                $query=$this->conection->prepare($sql);
                $query->bindValue(1, $user_id,PDO::PARAM_INT);
                $query->bindValue(2, $offset,PDO::PARAM_INT);
                $query->execute();
                return $query;
        }
        $sql='SELECT id, Titulo, Ano, imdb FROM filmes LIMIT ?, 4';
        $query=$this->conection->prepare($sql);
        $query->bindValue(1, $offset,PDO::PARAM_INT);
        $query->execute();
        return $query;
    }

    public function insereFilme(){
        $titulo=$_GET['titulo'];
        $ano=$_GET["ano"];
        $imdb=$_GET["imdb"];
        $sql='INSERT INTO filmes (Titulo, Ano, imdb) VALUES (?,?,?)';
        $query=$this->conection->prepare($sql);
        return $query->execute([$titulo,$ano,$imdb]);
    }

    public function updateFilme(){
        $id=$_GET['id'];
        $titulo=$_GET['titulo'];
        $ano=$_GET["ano"];
        $imdb=$_GET["imdb"];
        $sql='UPDATE filmes SET Titulo= ? , Ano= ? , imdb= ? WHERE id=?';
        $query=$this->conection->prepare($sql);
        return $query->execute([$titulo,$ano,$imdb,$id]);
    }

    public function deletaFilme(){
        $id=$_GET['id'];
        $sql='DELETE FROM filmes WHERE id = ?';
        $query=$this->conection->prepare($sql);
        return $query->execute([$id]);
    }

    public function avaliaFilme(){
        $filme_id=$_GET['filmeId'];
        $user_id=$_GET['userId'];
        $score=$_GET['score'];
        $sql='SELECT id FROM avaliacoes WHERE userId=? AND filmeId= ?';
        $query=$this->conection->prepare($sql);
        $query->execute([$user_id,$filme_id]);
        $result=$query->fetch();
        if(!$result) {
            $sql='INSERT INTO avaliacoes (userId, filmeId, avaliacao) VALUES (?,?,?)';
            $query=$this->conection->prepare($sql);
            return $query->execute([$user_id,$filme_id,$score]);
        }
        $id=$result['id'];
        $sql='UPDATE avaliacoes SET userId= ? , filmeId = ? , avaliacao= ? WHERE id=?';
        $query=$this->conection->prepare($sql);
        return $query->execute([$user_id,$filme_id,$score,$id]);
    }

    public function sugereFilme(){
        $user_id=isset($_GET['userId'])?$_GET['userId']:1;
        $sql='SELECT * FROM filmes WHERE id NOT IN (SELECT filmeId FROM avaliacoes WHERE userId = ?)';
        $query=$this->conection->prepare($sql);
        $query->execute([$user_id]);
        return $query;
    }
}


?>