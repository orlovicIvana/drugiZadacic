<?php
namespace MyApp\Connection;

class Connection{

    protected $connection;
    protected $host ="localhost";
    protected $username="root";
    protected $password="";
    protected $dbName="praksa";

    public function connect(){

        try{
            $this->connection = new \PDO("mysql:host=".$this->host.";dbname=".$this->dbName, $this->username,$this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        }catch(\PDOException $e){
            return false;
        }
        return $this->connection;  
    }    
    
}
?>