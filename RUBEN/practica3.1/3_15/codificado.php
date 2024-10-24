<?php
    include "../bibliotecas/cripto.php";

    $cadena = $_REQUEST["frase"];

    $codificado = codificar($cadena);

    echo $codificado;
?>