<?php

    function impares($cad){
        $impares = "";
        for ($i=1; $i < strlen($cad); $i+=2) { 
            $impares .= $cad[$i];
        }

        return $impares;
    }

    $cadena = "A quien madruga Dios le ayuda";

    $mostar = impares($cadena);

    echo $mostar;
?>