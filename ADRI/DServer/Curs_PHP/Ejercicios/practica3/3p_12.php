<?php

include '../bibliotecas/cripto.php';



$frase = "El perro de San Roque no tiene rabo";
$minus = strtolower($frase); // Convertir la frase a minúsculas
$numero = 2;
$frase_cod = codificar($minus);
echo "La frase codificada es: " . $frase_cod;
$frase_descod = descodificar($frase_cod);
echo "<br>";
echo "La frase descodificada es: " . $frase_descod;

