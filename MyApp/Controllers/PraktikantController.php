<?php
    namespace MyApp\Controllers;
    use MyApp\Controllers\Controller;
    use MyApp\Models\Praktikant;
    use PDO;

    class PraktikantController extends Controller{
        public $database;
        protected $requestMethod;
        protected $zaposleniId;

        public function __construct($database,$requestMethod,$zaposleniId){
           parent::__construct(new Praktikant($database));
           $this->requestMethod = $requestMethod;
           $this->zaposleniId =$zaposleniId;
        }    
        public function show($zaposleniId){
            $result = $this->zaposleni->Procitaj($zaposleniId);
            if (! $result) {
               return $this->notFoundResponse();
           }
           $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $row= $result->fetch(PDO::FETCH_ASSOC);
            if (! $row) {
               return $this->notFoundResponse();
           }
            $in=[
                "NazivGrupe"=>$row["NazivGrupe"],
               "PrezimePraktikanta"=>$row["PrezimePraktikanta"],
               "ImePraktikanta"=>$row["ImePraktikanta"]
           ];
           $response['status_code_header'] = 'HTTP/1.1 201 Created';
           
           return $response;
       }
    }
?>