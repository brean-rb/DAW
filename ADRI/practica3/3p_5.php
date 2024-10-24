<?php

$numeros = [];
echo "Letras en minuscula: <br>";
for ($i=97; $i <123; $i++) 
{ 
    $numeros[$i] = chr($i);
    echo $numeros[$i];
}
 echo "<br>Letras en mayusculas: <br>";
for ($i=97; $i <123; $i++) 
{ 
    $numeros[$i] = chr($i);
    echo strtoupper($numeros[$i]);
}

