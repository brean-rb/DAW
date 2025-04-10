<?php
include("curl_conexion.php");
session_start();

if (isset($_POST["cargar_guardias"])) {
    $params=[
        'document' => $_SESSION['document'],
        'accion' => 'historialGuardias'
    ];

    $respuesta = curl_conexion(URL,'POST',$params);
    $historial = json_decode($respuesta,TRUE);

    if (is_array($historial)) {
        if ($historial["error"]) {
            $_SESSION['historial'] = "";
        }else {
        $_SESSION['historial'] = $historial;
    } 
    }else{
        error_log("No se encontraron los resultados");
    }
    

    header('location:vistas/guardiasRealizadas.php?historial=1');
}