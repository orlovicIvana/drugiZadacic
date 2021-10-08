<?php
namespace MyApp\Models;


abstract class  Model{

  
    public  function Kreiraj(array $input){

        $sql="INSERT INTO ".$this->table. " (Ime,Prezime,Email,idGrupe) VALUES (:ime, :prezime,:email,:idGrupe)";
        try{
            $stmt=$this->connection->prepare($sql);
            $stmt->bindParam(":ime",$input["Ime"]);
            $stmt->bindParam(":prezime",$input["Prezime"]);
            $stmt->bindParam(":email",$input["Email"]);
            $stmt->bindParam(":idGrupe",$input["idGrupe"]);
            $stmt->execute();
            return $stmt;
        }catch(\PDOException $e){
            exit($e->getMessage());
        }
    }

    public function ProcitajSve(){
        $sql="SELECT * FROM ".$this->table ;
        try{
            $stmt=$this->connection->prepare($sql);
            $stmt->execute();
            return $stmt;
        }catch(\PDOException $e){
            exit($e->getMessage());
        }
    }
    public function Izmeni(array $input, $id){
        
        $sql="UPDATE ".$this->table." SET Ime=:ime,Prezime=:prezime,Email=:email,idGrupe=:idGrupe WHERE ID=:id";
        try{
            $stmt=$this->connection->prepare($sql);
            $stmt->bindParam(":ime",$input["Ime"]);
            $stmt->bindParam(":prezime",$input["Prezime"]);
            $stmt->bindParam(":email",$input["Email"]);
            $stmt->bindParam(":idGrupe",$input["idGrupe"]);
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            return $stmt;
        }catch(\PDOException $e){
            exit($e->getMessage());
        }
    }
    public function Obrisi($id){

        $sql="DELETE FROM ".$this->table." WHERE id=:id";
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