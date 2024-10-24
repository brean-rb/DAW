<?php
    $email = "maurodosantos@pernambuco.com";
    $i = 0;
    $espacio = true;

    while($i < strlen($email)){
        if($email[$i] == chr(32)){
            $espacio = false;
            break;
        }
        $i++;
    }

    if($espacio){
        echo "Email a analizar: '$email'<br>";
        echo "<br>";
        echo "Tiene " . strlen($email) . " letras.<br>";

        // Indica la posición del caracter "@" o FALSE si no está
        $posicion_arroba = strpos($email, "@");

        // Busca la aparición de un punto (.) partir de la arroba
        $posicion_punto = strpos($email, ".", $posicion_arroba);

        if ($posicion_arroba && $posicion_punto) {
            echo "Es una dirección de email válida<br>";
            $usuario = substr($email, 0, $posicion_arroba);
            $dominio = substr($email, $posicion_arroba + 1);
            echo "El nombre de usuario es: $usuario<br>";
            echo "El dominio es: $dominio<br>";
        } else {
            echo "No es una dirección de email válida<br>";
            if (!$posicion_arroba) {
                echo "Le falta el caracter arroba<br>";
            }
            if (!$posicion_punto) {
                echo "El dominio no es válido<br>";
            }
        }
    } else{
        echo "email no valido, contiene un espacio";
    }

    
?>