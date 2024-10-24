<?php
    function users($user, $passw){

        $verificacion = false;

        $usuarios = array("Juan" => "draco",
                        "Luisa" => "baobab",
                        "Antonio" => "olmo")
        ;

        foreach($usuarios as $key => $value){
            if(($key == $user) && ($value == $passw)){
                $verificacion = true;
            }

        }

        return $verificacion;
        
    }
?>