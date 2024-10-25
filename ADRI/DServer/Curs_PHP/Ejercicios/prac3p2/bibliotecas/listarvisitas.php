<?php
function listar_visita($archivo, $permiso){
    $abrir = fopen($archivo, $permiso);
    $tamaño = filesize($archivo);
    if ($abrir) {
        $cadena = fread($abrir, $tamaño);
        echo $cadena . "<br>";
        }
    else{
        echo "Error de apertura";
    }
     fclose($abrir);
}    
 ?>