<?php
    require realpath("../vendor/autoload.php");
    use MyApp\Models\PraktikantController;
    use MyApp\Router\Router;

    $nekaPromenljiva= new Router;
    $nekaPromenljiva->processRequest();


?>