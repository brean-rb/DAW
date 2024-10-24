<?php
    include("cuadrado.php");

    $cuadrado = new calculo(30, 20, 10);
    echo "el perimetro del cuadrado es: " . $cuadrado->calc_perimetro() . "<br>";
    echo "el area del cuadrado es: " . $cuadrado->calc_area() . "<br>";
    echo "el volumen del cuadrado es: " . $cuadrado->calc_volumen();
?>