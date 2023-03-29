<?php


class DataBaseHelper{
    private $connection = null;
    
    function __construct(){

        try{
            $this->connection = new PDO("mysql:host=".$_SERVER['SERVERNAME'].";dbname=".$_SERVER['DATABASENAME'], $_SERVER['USER'], $_SERVER['PASSWORD']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $error){
            echo json_encode("Error en la conexión, estamos un paso más cerca de resolverlo" . $error);
        }
    }

    public function getConnection(){
        return $this->connection;
    }
    public function closeConnection(){
        $this->connection = null;
    }
}