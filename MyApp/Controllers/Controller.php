<?php
namespace MyApp\Controllers;
use PDO;

class Controller{

    protected $zaposleni;

    public function __construct( $zaposleni = null){
        if($zaposleni !== null){
            $this->zaposleni = $zaposleni;
            }
    }
    
    public function index(){
        $res = $this->zaposleni->ProcitajSve();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $n = $res->rowCount();
        if($n>0){
            $Arr=[];
            while($row= $res->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $data=[
                    "id"=>$row["ID"],
                    "Ime"=>$row["Ime"],
                    "Prezime"=>$row["Prezime"],
                    "Email"=>$row["Email"],
                    "idGrupe"=>$row["idGrupe"]
                ];
                array_push($Arr,$data);
            }
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        echo $response['body'] = json_encode($Arr);
        return $response;
            }
    }

    public function show($zaposleniId){
            $res = $this->zaposleni->Procitaj($zaposleniId);
            if (! $res) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $row= $res->fetch(PDO::FETCH_ASSOC);
            if (! $row) {
            return $this->notFoundResponse();
        }
            $data=[
            "PrezimeMentora"=>$row["PrezimeMentora"],
            "ImeMentora"=>$row["ImeMentora"],
            "NazivGrupe"=>$row["NazivGrupe"]
        ];
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        echo $response['body'] = json_encode($data);
        return $response;
    }

    public function store()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if (! $this->validate( $input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->zaposleni->Kreiraj($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        return $response;
    }

    public function update($zaposleniId){
        $res = $this->zaposleni->Procitaj($zaposleniId);
        if (! $res) {
            return $this->notFoundResponse();
        }
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        if ( !$this->validate($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->zaposleni->Izmeni($input, $zaposleniId);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    public function destroy($zaposleniId){
        $res = $this->zaposleni->Procitaj($zaposleniId);
        $row= $res->fetch(PDO::FETCH_ASSOC);
        if (! $row) {
            return $this->notFoundResponse();
        }else{
            $this->zaposleni->Obrisi($zaposleniId);
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
        }
        return $response;
    }

    protected function validate($input){
        
        if (! isset($input['Ime']) || $input['Ime']==="" || $input['Ime']=== null ) {
            return false;
        }
        if (! isset($input['Prezime']) || $input['Prezime'] ==="" ||$input['Prezime'] === null ){
            return false;
        }
        if (! isset($input['idGrupe']) || $input['idGrupe']==="" || $input['idGrupe']===null ) {
            return false;
        }
        return true;
    }

    protected function unprocessableEntityResponse(){
        http_response_code(422);
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }

    protected function notFoundResponse(){
        http_response_code(404);
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
?>