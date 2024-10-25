<?php

$numeros = [];
for ($i = 0; $i < 26; $i++) {
    $numeros[$i] = chr($i + 97); // Generar el array con las letras del abecedario
}

$frase = "El perro de San Roque no tiene rabo";
$minus = strtolower($frase); // Convertir la frase a minúsculas

for ($i = 0; $i < strlen($minus); $i++) {
    $letra_actual = $minus[$i];
        // Encontrar la posición de la letra en el array $numeros
        for ($j = 0; $j < count($numeros); $j++) {
            if ($letra_actual == $numeros[$j]) {
                // Si es 'z', volvemos a 'a'
                if ($numeros[$j] == 'z') {
                    $minus[$i] = 'a';
                } else {
                    // Reemplazar con la siguiente letra
                    $minus[$i] = $numeros[$j + 1];
                }
                break;
            }
        }
    }


echo $minus;