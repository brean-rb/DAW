<?php
    echo "PRODUCTO - PRECIO/KG - PESO - PRECIO";
    //CONSTANTES
    define("JUDIAS", 3.50);
    define("PATATAS", 0.40);
    define("TOMATES", 1.00);
    define("MANZANAS", 1.20);
    define("UVAS", 2.50);
    

    //VARIABLES
    $peso_judias = 1.21;
    $peso_patatas = 1.73;
    $peso_tomates = 2.08;
    $peso_manzanas = 2.15;
    $peso_uvas = 0.77;


    //OPERACIONES
    $coste_jucias = JUDIAS * $peso_judias;
    $coste_patatas = PATATAS * $peso_patatas;
    $coste_tomates = TOMATES * $peso_tomates;
    $coste_manzanas = MANZANAS * $peso_manzanas;
    $coste_uvas = UVAS * $peso_uvas;

    //IMPRIMMIR
    echo "<br>";
    echo "JUDIAS - ". JUDIAS . " - " . $peso_judias . " - " . number_format($coste_jucias, 2);
    echo "<br>";
    echo "PATATAS - " . PATATAS . " - " . $peso_patatas . " - " . number_format($coste_patatas, 2);
    echo "<br>";
    echo "TOMATES - " . TOMATES . " - " . $peso_tomates . " - " . number_format($coste_tomates);
    echo "<br>";
    echo "MANZANAS - " . MANZANAS . " - " . $peso_manzanas . " - " . number_format($coste_manzanas , 2);
    echo "<br>";
    echo "UVAS - " . UVAS . " - " . $peso_uvas . " - " . number_format($coste_uvas , 2);
    
    $total = $coste_jucias + $coste_patatas + $coste_tomates + $coste_manzanas + $coste_uvas;

    echo "<br>";
    echo "TOTAL:  " . number_format($total, 2);
    echo "<br>";
    echo "GRACIAS POR SU COMPRA";
?>