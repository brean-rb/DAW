<?php
function pesetas_a_euros($pesetas){
    $valoren_euros =  $pesetas / PESETA ;
    return $valoren_euros;
}

function euros_a_pesetas($euros){
    $valoren_pesetas = PESETA * $euros;
    return $valoren_pesetas;
}