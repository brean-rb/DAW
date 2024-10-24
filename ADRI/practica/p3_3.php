<?php

$NIF = "g12345678";

if (strlen($NIF)== 9) {
    $cad = str_split($NIF, 1);
    $fin = [];   
    $mayus="";
    for ($i=0; $i <= count($cad); $i++) { 
    if((ord($NIF[$i]) >= 65 && ord($NIF[$i]) <= 90) || (ord($NIF[$i]) >= 97 && ord($NIF[$i]) <= 122)){
            $mayus = strtoupper($NIF[$i]);      
            $i++;
        } 
       
     $fin[$i] = $NIF[$i]; 
    }
    $ult = count($fin);
    $fin[$ult] = $mayus;
    for ($i=0; $i <=count($fin) ; $i++) { 
     echo $fin[$i];
    }
}