<?php

$abc = [];
$ABC = [];


for ($i=0; $i <=25 ; $i++) { 
    $abc[$i] = chr($i+97);
    echo $abc[$i];
}    
echo "<br>";
for ($i=0; $i <count($abc) ; $i++) { 
    $ABC[$i] = strtoupper($abc[$i]);
    echo $ABC[$i];

}
