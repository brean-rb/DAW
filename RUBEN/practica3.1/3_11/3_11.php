<?php
    include 'biblioteca_funcios.php';

    define("PESETAS", 166.368);

    $pesetas = 15643.899;
    $euros = 2445;

    $print_euros = pesetas_euros($pesetas, PESETAS);
    $print_pesetas =euros_pesetas($euros, PESETAS);

    echo "pesetas: " . $pesetas . " = " . number_format($print_euros, 2) . " euros" . "<br>";
    echo "euros: " . $euros . " = " . number_format($print_pesetas, 2) . " pesetas" . "<br>";
?> 