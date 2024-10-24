<?php
include('factura.php');

$factura = new Factura();

// Add two lines to the factura
$factura->agregarLinea(10, 2);  // First line: 10 * 2
$factura->agregarLinea(20, 2);  // Second line: 20 * 2

// Calculate total with IVA for the first line (index 0)
echo "Total con IVA: " . $factura->calcularFactura(0) . "<br>";

// Calculate a 10% discount on the total of the first line (index 0)
echo "Calculo de descuento del 10%: " . $factura->calculoDesc(0, 0.10) . "<br>";
