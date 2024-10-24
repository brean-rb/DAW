<?php

    include "usuarios.php";
    include "ok.php";

    $user = "";

    if(isset($_POST["user"])){
        $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_STRING);
    }
    
    $passw = $_REQUEST["passw"];

    $verificacio = users($user, $passw);

    $open_file = fopen("accesos.txt", "a"); 

    if($open_file){
        if($verificacio ){
            echo mensaje();
            $write_file = fwrite($open_file, "El usuario " . $user . " ha accedido al sistema \n");
        } else{
            header("location:error.html");
            $write_file = fwrite($open_file, "Intento fallido de acceso del usuario " . $user . "\n");
        }

    } else{
        echo "error al escribir en el archivo";
    }

    $close_file = fclose($open_file);

    if($close_file){
        echo "archivo cerrado correctamente";
    } else {
        echo "error al cerrar el archivo";
    }
    


?>