
<?php
include("Cuadrado.php");
$cuadrado1 = new Cuadrado(8, 4, 10);



echo "Perímetro del depósito 1: " . $cuadrado1->getPerimetro() . "\n";
echo "Área del depósito 1: " . $cuadrado1->getArea() . "\n";
echo "Volumen del depósito 1: " . $cuadrado1->getVolumen() . "\n";
?>