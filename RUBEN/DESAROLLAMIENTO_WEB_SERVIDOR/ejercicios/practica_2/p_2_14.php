<?php
    for ($i=1; $i <= 24 ; $i++) { 
        for($j = 0; $j <= 45; $j+=15){
            if ($i < 12 || $i == 24) {
                echo "son las : " . $i . "AM" . " Y " . $j . "minutos";
                echo "<br>";
            } else {
                echo "son las : " . $i . "PM" . " Y " . $j . "minutos";
                echo "<br>";
            }
            
        }
    }
?>