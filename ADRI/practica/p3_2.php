<?php

$cadena = "El perro de San Roque no tiene rabo";
$cad = trim($cadena);

echo "Las letras totales de la frase: '" . $cadena . "' son: " . strlen($cad) . " letras <br>";
$palabras = explode(" ", $cad);
echo "Las palabras totales de la frase: '" . $cadena . "' son: " . count($palabras) . " palabras <br>";

$letras = "";
for ($i=0; $i <count($palabras) ; $i++) { 
    $letras= strlen($palabras[$i]);
    echo "'" . $palabras[$i] . "' tiene: " . $letras . " letras <br>";
}