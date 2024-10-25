<?php
define("PESETA" , 166.368);
$pesetas = 15643.899;
$euros = 2445;

function pesetas_a_euros($pesetas){
    $valoren_euros =  $pesetas / PESETA ;
    return $valoren_euros;
}

function euros_a_pesetas($euros){
    $valoren_pesetas = PESETA * $euros;
    return $valoren_pesetas;
}
$valor_euro = pesetas_a_euros($pesetas);
echo number_format($valor_euro,2) . "€ <br>";

$valor_peseta = euros_a_pesetas($euros);
echo $valor_peseta . " pesetas";

