<?php
    include("deposito.php");

    $cuadrado1 = new deposito(32, 15, 20, "madera", 12);
    $cuadrado2 = new deposito(12, 15, 20, "madera", 16);

    $material1 = $cuadrado1->set_material();
    $material2 = $cuadrado2->set_material();

    $precio1 = $cuadrado1->set_precio();
    $precio2 = $cuadrado2->set_precio();

    echo "<h1>cuadrado1</h1><br>";
    echo "el perimetro del cuadrado es: " . $cuadrado1->calc_perimetro() . "<br>";
    echo "el area del cuadrado es: " . $cuadrado1->calc_area() . "<br>";
    echo "el volumen del cuadrado es: " . $cuadrado1->calc_volumen();

    echo "<h1>cuadrado2</h1><br>";
    echo "el perimetro del cuadrado es: " . $cuadrado2->calc_perimetro() . "<br>";
    echo "el area del cuadrado es: " . $cuadrado2->calc_area() . "<br>";
    echo "el volumen del cuadrado es: " . $cuadrado2->calc_volumen();

    $resultado = $cuadrado1->son_iguales($material1, $material2, $precio1, $precio2);

    echo $resultado;
?>