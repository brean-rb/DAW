<?php

function comprobar($user, $contra){
    $usuarios = array("Juan" => "draco",
    "Luisa" => "baobab",
    "Antonio" => "olmo");

    $verificacion = false;
    foreach ($usuarios as $key => $value) {
        if(($key == $user)&& ($value == $contra)){
            $verificacion = true;
        }
    }
    return $verificacion;
}