<?php

include("conexion_bd.php");

$metodo = $_SERVER["REQUEST_METHOD"];

switch ($metodo) {
    case 'GET':
        if (isset($_REQUEST["nif"])) {
            $nif = filter_input(INPUT_GET, "nif", FILTER_SANITIZE_STRING);
            $sql = "SELECT * FROM empleado WHERE nif = '" . $nif . "'";

            $con_bd = conexion($sql);
            if ($con_bd) {
                echo json_encode($con_bd, TRUE);
            } else{
                echo json_encode("Error en proceso sobre la BD", TRUE);
            }
        }
        break;
    case 'PUT':
        if (isset($_REQUEST["nif"])) {
            # code...
        }
    default:
        # code...
        break;
}