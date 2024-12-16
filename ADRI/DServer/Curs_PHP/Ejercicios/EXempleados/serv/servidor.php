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
    case 'DELETE':
        if (isset($_REQUEST["nif"])) {
            $nif = filter_input(INPUT_GET, "nif", FILTER_SANITIZE_STRING);
            $sql = "DELETE FROM empleado WHERE nif = '" . $nif . "'";

            $con_bd = conexion($sql);
            if ($con_bd) {
                echo json_encode($con_bd, TRUE);
            } else{
                echo json_encode("Error en proceso sobre la BD", TRUE);
            }
        }
        break;
    case 'POST':
        parse_str(file_get_contents("php://input"),$recogerParams);
        $nif = $recogerParams['nif'];
        $nombre = $recogerParams['nombre'];
        $sueldo = $recogerParams['sueldo'];
        $telf = $recogerParams['telf'];

        //Cantidad de presupuesto antes de dar el alta:

        $cant_sql = "SELECT presupuesto FROM presupuesto";
        $con_bd=conexion($cant_sql);
        if (!$con_bd) {
            echo json_encode("Error en encontrar cantidad de presupuesto", TRUE);
        } else{
            $cantidadPres = $con_bd['presupuesto'];
            if ($cantidadPres<$sueldo) {
                echo json_encode("Presupuesto insuficiente",TRUE);
            } else{
                $sql = "INSERT INTO empleado (nombre, telefono, nif, sueldo) VALUES ('" . $nombre . "', '" . $telf . "', '" . $nif . "', " . $sueldo . ")";
                $con_bd = conexion($sql);
                if ($con_bd) {
                    $total = $cantidadPres - $sueldo;
                    json_encode($con_bd,TRUE);
                    $sql = "UPDATE presupuesto SET presupuesto = '".$total."' WHERE presupuesto = '".$cantidadPres."';";
                    $con_bd = conexion($sql);
                    if (!$con_bd) {
                        echo json_encode("Error al modificar el presupuesto restante",TRUE);
                    }
                } else{
                    echo json_encode("Error al dar de alta al nuevo empleado",TRUE);
                }
            }
        }
        break;
    case 'PUT':
        
        break;
    default:
        # code...
        break;
}