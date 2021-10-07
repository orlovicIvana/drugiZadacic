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
        $sql="SELECT  m.Prezime AS PrezimeMentora,m.Ime AS ImeMentora,g.Naziv AS NazivGrupe  FROM ". $this->table."  m INNER JOIN grupe g ON m.idGrupe= g.ID WHERE m.ID=:id";   
        try{
            $stmt=$this->connection->prepare($sql);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
}
?>