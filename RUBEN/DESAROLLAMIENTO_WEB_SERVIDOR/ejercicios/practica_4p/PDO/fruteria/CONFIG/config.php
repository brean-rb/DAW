<?php

    define("SERVIDOR", "localhost");
    define("USER", "root");
    define("PASSW", "");
    define("DATABASE", "fruteria");

    $conexion = false;

    $conec = new PDO('mysql:host=' . SERVIDOR . ';dbname=' . DATABASE, USER, PASSW);

    if($conec){
        $conexion = true;
    }

?>