<?php

include("Deposito.php");

// Crea dos objetos Deposito correctamente
$deposito1 = new Deposito(8, "mármol", 22);
$deposito2 = new Deposito(8, "piedra", 22);

$deposito1->esIgual($deposito2);
$deposito1->masCaro($deposito2);
?>
