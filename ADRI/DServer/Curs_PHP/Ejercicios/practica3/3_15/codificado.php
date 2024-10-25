<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

include '../../bibliotecas/cripto.php';


$frase= $_REQUEST["campo"];
$num =$_REQUEST["numerocod"];



$minus = strtolower($frase);
$frase_cod = codificar($minus,$num);

echo $frase_cod;
?> 
<p>Desea descodificar la frase?</p>
<input type="radio" name = "descod" value = "Si">Si
<input type="radio" name = "descod" value = "No">No
<input type="submit" value = "enviar">
<?php
include '../../bibliotecas/cripto.php';

$result = $_REQUEST ["descod"];

if ($result == "Si") {
    $frase_descod = descodificar($frase_cod,$num);
}

?>
</body>
</html>

