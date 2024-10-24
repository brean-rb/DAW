<?php

$letras = [];
for ($i = 0; $i < 26; $i++) {
    $letras[$i] = chr($i + 97); // Generar el array con las letras del abecedario
}

$frase = "El perro de San Roque no tiene rabo";
$minus = strtolower($frase); // Convertir la frase a minúsculas

for ($i = 0; $i < strlen($minus); $i++) {
    $letra_actual = $minus[$i];
        // Encontrar la posición de la letra en el array $letras
        for ($j = 0; $j < count($letras); $j++) {
            if ($letra_actual == $letras[$j]) {
                // Si es 'z', volvemos a 'a'
                if ($letras[$j] == 'z') {
                    $minus[$i] = 'a';
                } else {
                    // Reemplazar con la siguiente letra
                    $minus[$i] = $letras[$j + 3];
                }
                break;
            }
        }
    }


echo $minus;