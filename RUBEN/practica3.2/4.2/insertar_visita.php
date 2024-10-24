<?php
    $user = [];

    if(isset($_POST["user"])){
        $user = filter_input(INPUT_POST, "user", FILTER_SANITIZE_STRING);
    }

    $comentario = [];

    if(isset($_POST["coment"])){
        $comentario = filter_input(INPUT_POST, "coment", FILTER_SANITIZE_STRING);
    } 
    

    $open_file = fopen("visitas.txt", "a");

    if($open_file){
        $write_file_coment = fwrite($open_file, "el usuario: " . $user . " comentario: " . $comentario . "<br>" . "\n");
        fclose($open_file); 
        header("Location: libro_visitas.php");
    } else{
        echo "error al escribir en el archivo";
    }

    fclose($open_file);
?>
