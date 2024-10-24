<?php
    $abecedario = [];

    for ($i = 97; $i <= 122; $i++) { 
        $abecedario[] = chr($i);
    }

    $frase = "perro ladrador poco mordedor";
    $cadena = strtolower($frase);

    for ($i = 0; $i < strlen($cadena); $i++) {
        $letra = $cadena[$i];


        for ($j = 0; $j < count($abecedario); $j++) {
            if ($letra == $abecedario[$j]) {
                if ($abecedario[$j] == 'z') {
                    $cadena[$i] = 'a';
                } else {
                    $cadena[$i] = $abecedario[$j + 1];
                }
                break;
            }
        }
    }

    echo $cadena;
?>
