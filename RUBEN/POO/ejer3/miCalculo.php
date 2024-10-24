<?php
    include("calculo.php");

    $calc1 = new calculo(8, 16, 3);
    $calc2 = new calculo(9, 22, 1);

    $calc1->calc();
    $calc2->calc();

    $calc1->es_equivalente($calc2);
?>
