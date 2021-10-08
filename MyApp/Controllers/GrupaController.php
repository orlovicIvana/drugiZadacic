<?php
namespace MyApp\Controllers;
use PDO;
use MyApp\Controllers\Controller;
use MyApp\Models\Grupa;

class GrupaController extends Controller{
    public $database;
    protected $requestMethod;
    protected  $grupaID;
 
    public function __construct($database,$requestMethod,$grupaID){
       parent::__construct(new Grupa($database));
       $this->requestMethod = $requestMethod;
       $this->grupaID = $grupaID;
    } 
    
    public function listing(){
        $result = $this->zaposleni->listingGrupe();
        $n=$result->rowCount();
        // var_dump($n);
        if($n>0){
            $inArr=[];
            while($row= $result->fetch(PDO::FETCH_ASSOC)){
            
                extract($row);

                $in=[
                    "NazivGrupe"=>$row["NazivGrupe"],
                    "ImeMentora"=>$row["ImeMentora"],
                    "PrezimeMentora"=>$row["PrezimeMentora"],
                    "ImePraktikanta"=>$row["ImePraktikanta"],
                    "PrezimePraktikanta"=>$row["PrezimePraktikanta"]
                ];
                array_push($inArr,$in);
            }
        echo $response['body'] = json_encode($inArr);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        return $response;
         }
    }
    public function index(){
        $result = $this->zaposleni->ProcitajSve();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $n=$result->rowCount();
        if($n>0){
            $inArr=[];
            while($row= $result->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $in=[
                    "id"=>$row["ID"],
                    "Naziv"=>$row["Naziv"]
                ];
                array_push($inArr,$in);
            }
        echo $response['body'] = json_encode($inArr);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        return $response;
         }
    }
    public function show($grupaID){
        $result = $this->zaposleni->Procitaj($grupaID);
        $n=$result->rowCount();
        // var_dump($n);
        if($n>0){
            $inArr=[];
            while($row= $result->fetch(PDO::FETCH_ASSOC)){
            
                extract($row);

                $in=[
                    "NazivGrupe"=>$row["NazivGrupe"],
                    "ImeMentora"=>$row["ImeMentora"],
                    "PrezimeMentora"=>$row["PrezimeMentora"],
                    "ImePraktikanta"=>$row["ImePraktikanta"],
                    "PrezimePraktikanta"=>$row["PrezimePraktikanta"]
                ];
                array_push($inArr,$in);
            }
        echo $response['body'] = json_encode($inArr);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        return $response;
         }
   }
  
    protected function validate($input){
        if( ! isset($input['Naziv']) || $input['Naziv']==="" || $input['Naziv']=== null ){
            return false;
        }
        return true;
    }
}