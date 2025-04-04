<?php
include("curl_conexion.php");
session_start();

if (isset($_POST["fentrada"])) {
    $document = $_SESSION["document"];
    $fecha = date('Y-m-d');
    $hora_entrada = date('H:i:s');

    $params = [
        'document' => $document,
        'fecha' => $fecha,
        'hora_entrada' => $hora_entrada
    ];

    // Petición REST para fichar entrada
    $response = curl_conexion(URL , 'POST', $params); 
    $resp = json_decode($response, true);

    if ($resp["success"]) {
        echo json_encode(["success" => "Entrada registrada correctamente"]);
    } else {
        echo json_encode(["error" => "Error al registrar la entrada"]);
    }
}

if (isset($_POST["fsalida"])) {
    $document = $_SESSION["document"];
    $fecha = date('Y-m-d');
    $hora_salida = date('H:i:s');

    $params = [
        'document' => $document,
        'fecha' => $fecha,
        'hora_salida' => $hora_salida
    ];

    // Petición REST para fichar salida
    $response = curl_conexion(URL . '/fichar_salida', 'POST', $params); 
    $resp = json_decode($response, true);

    if ($resp["success"]) {
        echo json_encode(["success" => "Salida registrada correctamente"]);
    } else {
        echo json_encode(["error" => "Error al registrar la salida"]);
    }
}
?>
