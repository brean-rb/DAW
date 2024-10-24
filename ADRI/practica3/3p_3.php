<?php
$nif = "12345678Y";
$contador = 0;
 
for ($i=0; $i < strlen($nif); $i++) { 
    $caracter = ord($nif[$i]);

    if (($caracter >= 48 && $caracter <= 57) ||
        ($caracter >= 65 && $caracter <= 90)||
        ($caracter >= 97 && $caracter <= 122)) {
            $contador++;
    }
}

if ($contador==9) {
    echo "El NIF es correcto<br>";
    $NIF_2 = "";

    for ($i=0; $i <strlen($nif) ; $i++) { 
        if ($i == 8) {
           $letra = strtoupper($nif[$i]);
           $NIF_2 .= $letra; 
        } else{
            $letra_Mayus = $nif[$i];
            $NIF_2 .= $letra_Mayus;
        }
    }

    echo $NIF_2;
} else {
    echo "El NIF es incorrecto";
}