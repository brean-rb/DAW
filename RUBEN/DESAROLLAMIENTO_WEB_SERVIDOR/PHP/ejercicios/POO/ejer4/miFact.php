<?php
    include('factura.php');

    $factura = new factura();

    $factura->add_line_fact(10, 2);

    echo "total con IVA: " . $factura->calc_fact(0) . "<br>";

    echo "total con descuento: " . $factura->desc_calc_fact(0, 0.10);
?>