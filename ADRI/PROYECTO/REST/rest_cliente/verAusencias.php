<?php
include("curl_conexion.php");
session_start();

if (isset($_GET["cargar_guardias"])) {
   
   $params_get = [
        'document' => $_SESSION['document'],
       'accion' => 'verGuardias',
   ];
   $url_get = URL . '?' . http_build_query($params_get);

   // Realizar la petición GET
   $response = curl_conexion($url_get, 'GET'); // Pasamos la URL completa a curl_conexion

   // Decodificar la respuesta JSON
   $guardiasPen = json_decode($response, true);

   // Verificar si la respuesta contiene datos válidos
   if (is_array($guardiasPen)) {
       $_SESSION["guardiasPen"] = $guardiasPen;  // Guardamos las guardias en la sesión
   } else {
       // Si la respuesta no es válida o no hay datos
       $_SESSION["guardiasPen"] = [];
       error_log("Error al recibir las guardias: Respuesta inválida o vacía");
   }

   // Redirigir al usuario
   header('Location: vistas/consultaAusencias.php');
   
}elseif (isset($_POST["asignar"])) {
    $params = [
        'sesion' => $_POST["sesion_id"],
        'documentAus' => $_POST["document"],
        'document' => $_SESSION["document"],
        'cubierto' => 1,
        'accion' => 'asignarGuardia'
    ];

    $response = curl_conexion(URL,'POST',$params);
    $resp = json_decode($response, TRUE);

    if (isset($resp["exito"]) && $resp["exito"]) {
        header('Location: vistas/consultaAusencias.php?cargar_guardias=1');
    } else {
        $errorMessage = isset($resp["mensaje"]) ? $resp["mensaje"] : "Error desconocido al cambiar";
        error_log("Error al cambiar: " . $errorMessage);
    }
    exit();
}

