<?php
namespace MyApp\Router;
use MyApp\Connection\Connection;

class Router{
    public $route=[];
    function processRequest(){
        $db= new Connection;
        $db=$db->connect();
        $route=[
            "GET"=>[
                "/praktikanti"=>"MyApp\Controllers\PraktikantController@index",
                "/praktikanti/id"=>"MyApp\Controllers\PraktikantController@show",
                "/mentori"=>"MyApp\Controllers\MentorController@index",
                "/mentori/id"=>"MyApp\Controllers\MentorController@show",
                "/grupe"=>"MyApp\Controllers\GrupaController@index",
                "/grupe/id"=>"MyApp\Controllers\GrupaController@show",
                "/grupe/listing"=>"MyApp\Controllers\GrupaController@listing"
                ],
            "POST"=>[
                "/praktikanti"=>"MyApp\Controllers\PraktikantController@store",
                "/mentori"=>"MyApp\Controllers\MentorController@store",
                "/grupe"=>"MyApp\Controllers\GrupaController@store",
                ],
            "PUT"=>[
                "/praktikanti/id"=>"MyApp\Controllers\PraktikantController@update",
                "/mentori/id"=>"MyApp\Controllers\MentorController@update",
                "/grupe/id"=>"MyApp\Controllers\GrupaController@update"
            ],
            "DELETE"=>[
                "/praktikanti/id"=>"MyApp\Controllers\PraktikantController@destroy",
                "/mentori/id"=>"MyApp\Controllers\MentorController@destroy",
                "/grupe/id"=>"MyApp\Controllers\GrupaController@destroy"]
            ];
        $requestMethod =strtoupper ($_SERVER["REQUEST_METHOD"]);
        $uri=$_SERVER['REQUEST_URI'];
        $personId= isset($_GET["id"]) ? (int)$_GET["id"]:null;
        if($personId !== null || isset($_GET["page"]) || isset($_GET["sort_by"])){
            $uri = explode("?",$uri);
            $uri=$uri[count($uri) - 2];   
        }           
        $route=$route[$requestMethod][$uri];
        $routeName= explode("@",$route);
        $className=$routeName[count($routeName)-2];
        $methodName=$routeName[count($routeName)-1];
        $object = new $className($db,$requestMethod,$personId);
        return $object->{$methodName}($personId);
    }
}

?>