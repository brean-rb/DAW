<?php
    $dni = "20314406p";
    $contador = 0;

    for($i = 0; $i < strlen($dni); $i++){
        $caracter = ord($dni[$i]);
        
        if(($caracter >= 48 && $caracter <= 57) || 
           ($caracter >= 65 && $caracter <= 90) || 
           ($caracter >= 97 && $caracter <= 122)){
                $contador++;
        }
    }

    if ($contador == 9){
        echo "el dni es correcto<br>";
        $dni_2 = "";

        for ($i = 0; $i < strlen($dni); $i++) { 
            if($i == 8){
                $letra = strtoupper($dni[$i]);
                $dni_2 .= $letra;
            } else {
                $letra_up = $dni[$i];
                $dni_2 .= $letra_up;
            }
        }

        echo $dni_2;
    } else {
        echo "el dni es incorrecto<br>";
    }
?>
