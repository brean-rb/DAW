<?php

    function conteo_letras($cad){

        $sin_espacios = str_replace(" ", "", $cad);

        $contador = strlen($sin_espacios);

        return $contador;
    }

    function conteo_palabras ($cad){
        $contador = 1;
        for($i = 0 ; $i <= strlen($cad); $i++){
            if($cad[$i] == chr(32)){
                $contador++;
            }
        }
        return $contador;
    }

    function conteo_palabras_letras($cad){
        $i = 0;
        
        while ($i < strlen($cad)) {
            $contador = 0;
            $palabra  = "";
            
            while(($cad[$i] != chr(32)) && (($i <strlen($cad)))){
                $palabra .= $cad[$i];
                $contador ++;
                $i++;
            }
            
            echo $palabra . ": " . $contador . "<br>";
            $i++;
            
        }
    }

    // cadena a analizar
    $cadena = "El perro de San Roque no tiene rabo";

        // contar letras

        $mostrar = conteo_letras($cadena);
        echo "letras: " . $mostrar . "<br>";

        // numero de palabras
    
        $mostrar_2 = conteo_palabras($cadena);
        echo "palabras: " . $mostrar_2. "<br>";

        //letras por palabras

        $mostrar_3 = conteo_palabras_letras($cadena);
        

?>