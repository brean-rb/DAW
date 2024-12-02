<?php

    define("SERVER", "localhost");
    define("USER", "root");
    define("PASSWORD", "");
    define("DATABASE", "baloncesto");

    $conexion = false;

    $conec = @mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

    if($conec){
        $conexion = true;
    }

?>
