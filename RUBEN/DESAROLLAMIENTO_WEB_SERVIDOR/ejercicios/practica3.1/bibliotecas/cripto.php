<?php

    function abeceario(){
        $abecedario = [];

        for ($i = 97; $i <= 122; $i++) { 
            $abecedario[] = chr($i);
        }

        return $abecedario;
    }
    
    function codificar($frase, $num = 1){

        $abecedario = abeceario();

        $cadena = strtolower($frase);

        for ($i = 0; $i < strlen($cadena); $i++) {
            $letra = $cadena[$i];


            for ($j = 0; $j < count($abecedario); $j++) {
                if ($letra == $abecedario[$j]) {
                    if ($abecedario[$j] == 'z') {
                        $cadena[$i] = 'a';
                    } else {
                        $cadena[$i] = $abecedario[$j + $num];
                    }
                    break;
                }
            }
        }

        return $cadena;
    }

    function descodificar($frase, $num = 1){
        $abecedario = abeceario();

        $cadena = strtolower($frase);

        for ($i = 0; $i < strlen($cadena); $i++) {
            $letra = $cadena[$i];


            for ($j = 0; $j < count($abecedario); $j++) {
                if ($letra == $abecedario[$j]) {
                    if ($abecedario[$j] == 'z') {
                        $cadena[$i] = 'a';
                    } else {
                        $cadena[$i] = $abecedario[$j - $num];
                    }
                    break;
                }
            }
        }

        return $cadena;
    }
?>
