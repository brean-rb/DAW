<?php
$precio_kg = ["Tomate" => 1.00,
            "Manzana" => 1.20,
            "Uva" => 2.50,
            "Patata" => 0.40,
            "Judia" => 3.50];
$lista_compra = ["Tomate" => 1.21,
            "Manzana" => 2.01,
            "Uva" => 4.5,
            "Patata" => 5.2,
            "Judia" => 3.06];
    echo "NOMBRE - PRECIO/KG - PESO A COMPRAR - PRECIO TOTAL";

  //IMPRIMIR
  foreach ($precio_kg as $verdura => $precio) {
    $peso = $lista_compra[$verdura];
  echo "<br>";
  echo $verdura . " - " . $precio . " - " . $peso . " - " . number_format($precio*$peso, 2);
  
  }
?>