<?php
    require realpath("../vendor/autoload.php");
    use MyApp\Models\PraktikantController;
    use MyApp\Connection\Connection;

    $db = new Connection;
    $db = $db->connect();

    $p = new Praktikant($db);
    var_dump($p->show(1));
?>