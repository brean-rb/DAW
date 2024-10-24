<?php

    include("calculadora.php");

    if((isset($_POST["num1"])) && isset($_POST["num2"]) && isset($_POST["ope"])){

        if((filter_input(INPUT_POST,"num1", FILTER_VALIDATE_INT)) && filter_input(INPUT_POST ,"num2", FILTER_VALIDATE_INT)){
            $num1 = $_POST["num1"];
            $num2 = $_POST["num2"];
            $ope = $_POST["ope"];
    
            $micalculo = new calculadora($num1, $num2, $ope);
    
            $result = $micalculo->calculos();
    
            echo "<b>". $result . "</b>";
        }
    } else{
        echo "no has enviado uno de los numeros";
    }


?>