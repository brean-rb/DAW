<?php

$usuario = array();
$coment = array();

if (isset($_POST["usuario"])) {
    $usuario= filter_input( INPUT_POST, "usuario" , FILTER_SANITIZE_STRING);
    
    if (isset($_POST["comentario"])) {
        $coment= filter_input( INPUT_POST, "comentario" , FILTER_SANITIZE_STRING);

    $lista = [$usuario => $coment];    
    $archivo = fopen("visitas.txt", "a");
    if ($archivo) {
        fwrite($archivo, $usuario . ": " . $coment . "<br>" . "\n");
        header("location:libro_visitas.php");
    }  
    fclose($archivo);  
}
}