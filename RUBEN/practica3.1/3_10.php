<?php
    /*(1 euro =
    166.368 ptas)
    pesetas_a_euros
    euros_a_pesetas*/

    define("PESETAS", 166.368);

    function pesetas_euros($pes){
        return $pes / PESETAS;
    }

    function euros_pesetas($eur){
        return $eur * PESETAS;
    }

    $pesetas = 15643.899;
    $euros = 2445;

    $print_euros = pesetas_euros($pesetas);
    $print_pesetas =euros_pesetas($euros);

    echo "pesetas: " . $pesetas . " = " . number_format($print_euros, 2) . " euros" . "<br>";
    echo "euros: " . $euros . " = " . number_format($print_pesetas, 2) . " pesetas" . "<br>";
     
?>