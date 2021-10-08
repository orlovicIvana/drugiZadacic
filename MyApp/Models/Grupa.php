<?php
namespace MyApp\Models;
use MyApp\Models\Model;
use PDO;
use PDOException;

class Grupa extends Model{
    protected $connection;
    protected $table="grupe";

    public function __construct($db){
        $this->connection=$db;
    }
    public function ProcitajSve(){
        $sql="SELECT * FROM ".$this->table . " ORDER BY Naziv";
        try{
            $stmt=$this->connection->prepare($sql);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }

    public function Procitaj($id){
        $q="SELECT g.Naziv AS NazivGrupe, m.Ime AS ImeMentora, m.Prezime AS PrezimeMentora,p.Ime AS ImePraktikanta,p.Prezime AS PrezimePraktikanta FROM ". $this->table."  g LEFT JOIN mentori m ON g.ID=m.idGrupe LEFT JOIN praktikanti p ON g.ID=p.idGrupe WHERE g.ID=:id";   
        try{
            $stmt=$this->connection->prepare($q);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }

    public  function Kreiraj(Array $input){
        $sql="INSERT INTO ".$this->table. " (Naziv) VALUES (:naziv)";
        try{
            $stmt=$this->connection->prepare($sql);
            $stmt->bindParam(":naziv",$input["Naziv"]);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
    public function Izmeni( Array $input, $id){
        $sql="UPDATE ".$this->table." SET Naziv= :naziv WHERE ID= :id";
        try{
            $stmt=$this->connection->prepare($sql);
            $stmt->bindParam(":naziv",$input["Naziv"]);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
    public function listingGrupe(){
        $total = $this->connection->query("SELECT COUNT(*) FROM ".$this->table."  g LEFT JOIN mentori m ON g.ID=m.idGrupe LEFT JOIN praktikanti p ON g.ID=p.idGrupe")->fetchColumn();
        var_dump($total);
        $limit = 2;
        //$pages = ceil($total / $limit);
       
        $page = (isset($_GET['page']) && $_GET['page'] > 0) ? intval($_GET['page']) : 1;
      
        $offset = abs($page - 1)  * $limit;

        $sql="SELECT g.Naziv AS NazivGrupe, m.Ime AS ImeMentora, m.Prezime AS PrezimeMentora,p.Ime AS ImePraktikanta,p.Prezime AS PrezimePraktikanta FROM ". $this->table."  g INNER JOIN mentori m ON g.ID=m.idGrupe INNER JOIN praktikanti p ON g.ID=p.idGrupe ORDER BY g.Naziv LIMIT :limit  OFFSET :offset";
       
        try{
            $stmt=$this->connection->prepare($sql);
            $stmt->bindParam(':offset',$offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
           
            $stmt->execute();
            var_dump($offset);
            return $stmt;
        }catch(PDOException $e){
            exit($e->getMessage());
        }
    }
    
}
?>