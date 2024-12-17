<?php
    include "bibliotecas/cripto.php";

    $frase = "hola mundo";
    $numero = 1;

    $frase_cod = codificar($frase, $numero);
    $frase_descod = descodificar($frase_cod, $numero);

    echo "la frase codificada es: " . $frase_cod . "<br>";
    echo "la frase descodificada es: " . $frase_descod;
?>