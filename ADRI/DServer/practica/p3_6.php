<?php
$abc = [];
for ($i=0; $i <=25 ; $i++) { 
    $abc[$i] = chr($i+97);
} 

$cadena = "perro ladrador poco mordedor";
$cadcod= "";

for($i=0; $i < strlen($cadena); $i++){
    if ($cadena[$i] == "z") {
        $cadcod[$i] = "a";
    }else if($cadena == " "){
    $cadcod .= " ";
    }else{
        $cadcod .= $abc[$i+1];
    }
}

echo $cadcod;
