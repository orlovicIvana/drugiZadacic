<?php
namespace MyApp\Models;
use MyApp\Models\Model;

class Praktikant extends Model{

    protected $table = "praktikanti";
    protected $connection;

    public function __construct($database){
        $this->connection = $database;
    }

    public function Procitaj($id){
        $sql="SELECT  p.Prezime AS PrezimePraktikanta,p.Ime AS ImePraktikanta,g.Naziv AS NazivGrupe  FROM ". $this->table."  p INNER JOIN grupe g ON p.idGrupe= g.ID WHERE p.ID=:id";   
        try{
            $stmt=$this->connection->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt;
        }catch(\PDOException $e){
            exit($e->getMessage());
        }
    }
}
?>