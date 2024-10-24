<?php
    $mayus = [];

    echo "mayusculas <br>";
    for ($i=97; $i <=122 ; $i++) { 
        $mayus[$i] = chr($i);
        echo $mayus[$i];
    }

    echo "<br>";

    $min = [];

    echo "minusculas <br>";
    for ($i=65; $i <=90 ; $i++) { 
        $min[$i] = chr($i);
        echo $min[$i];
    }

?>