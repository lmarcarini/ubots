<?php

class Database{

    public $conection;

    public function getConection(){
        $this->conection = null;
        try{
            $this->conection=new MyPDO();
        }catch(\PDOException $e){
            throw new \PDOException($e->getMessage(),(int)$e->getCode());
        }
    }
}

?>