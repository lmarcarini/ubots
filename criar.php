<?php

class MyPDO extends PDO
{
    public function __construct($file = 'configuracao.ini')
    {
        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable to open ' . $file . '.');
       
        $dns = $settings['database']['driver'] .
        ':host=' . $settings['database']['host'] .
        ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
        ';dbname=' . $settings['database']['schema'];
       
        parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
    }
}

try{
    $pdo=new MyPDO();
}catch(\PDOException $e){
    throw new \PDOException($e->getMessage(),(int)$e->getCode());
}

$searchid = '1';
$query=$pdo->prepare('SELECT Titulo FROM Filmes WHERE id = ?');
$query->execute([$searchid]);
$movie=$query->fetch();

echo json_encode($movie);

?>