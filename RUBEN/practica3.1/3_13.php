<?php
    include "bibliotecas/cripto.php";

    $ciudades = ["madrid", "barcelona", "valencia", "sevilla", "zaragoza"];

    $codificado = [];
    foreach($ciudades as $ciudad){
        $codificado[] = codificar($ciudad);
    }

    $descodificado = [];
    foreach($codificado as $ciudad_cod){ // Aquí cambiaste de $codficado a $codificado
        $descodificado[] = descodificar($ciudad_cod);
    }

    // Mostrar las ciudades codificadas
    echo "Las ciudades codificadas son: <br>";
    foreach($codificado as $cod_ciudad){
        echo $cod_ciudad . "<br>";
    }

    echo "<br>";

    // Mostrar las ciudades descodificadas
    echo "Las ciudades descodificadas son: <br>";
    foreach($descodificado as $descod_ciudad){
        echo $descod_ciudad . "<br>";
    }
?>
