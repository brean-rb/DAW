<?php
    define("RADIO", 6378);
    define("DISTANCIA", 150000000);
    define("PI", 3.141529);

    $formula_1 = 2 * PI * RADIO;
    $formula_2 =  DISTANCIA / $formula_1;

    echo "el radio de la tierra es: " . RADIO;
    echo "<br>";
    echo "la distancia de la tierra al sol es: ". DISTANCIA;
    echo "<br>";
    echo "circunferencia es: " . $formula;
    echo "<br>";
    echo "vueltas al mundo equivalentes a la distancia al sol: " . $formula_2;
?>