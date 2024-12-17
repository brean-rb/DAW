<?php

/* 
 * 
 * Aplicación de la fruteria pero usando servicios Web REST
 * Servidor REST
 * 
 */
include 'funcion_conexion_bd.php';
DEFINE ("SERVIDOR", "localhost");
DEFINE ("USER", "root");
DEFINE ("PASSWD", "");
DEFINE ("BASE_DATOS", "fruteria");

$metodo = $_SERVER['REQUEST_METHOD'];
$recurso = filter_input(INPUT_SERVER, 'REQUEST_URI',FILTER_SANITIZE_URL);

switch($metodo){
    case 'GET':
        if(isset($_REQUEST['temporada'])){
            $temporada = filter_input(INPUT_GET, 'temporada',FILTER_SANITIZE_STRING);
            $temporada = strtoupper($temporada);
            $sql = "SELECT id, fruta FROM precios WHERE temporada = '" . $temporada  . "'";
        }
        if(isset($_REQUEST['tempo']) && isset($_REQUEST['fruta'])){
            $temporada = filter_input(INPUT_GET, 'tempo',FILTER_SANITIZE_STRING);
            $temporada = strtoupper($temporada);
            $fruta = filter_input(INPUT_GET, 'fruta',FILTER_SANITIZE_STRING);
            $fruta = strtoupper($fruta);
            $sql = "SELECT * FROM precios WHERE temporada = '" . $temporada  . "' and fruta = '" . $fruta . "'";
        }
        $con_bd = conexion_bd(SERVIDOR, USER, PASSWD,  BASE_DATOS, $sql);
        echo json_encode($con_bd, TRUE);
        break;
    case 'PUT':
        // Los parámetros en los métodos PUT y DELETE se pueden enviar como
        // con el GET y se reciben de la misma forma (como arriba), o como POST,
        // pero para recibirlos se usa la instrucción de abajo:
        parse_str(file_get_contents("php://input"), $put_params);
        $id = $put_params['id'];
        $precio_kg = $put_params['precio_kg'];
        $sql = "UPDATE precios SET precio_kg = '" . $precio_kg . "' WHERE id = '" . $id . "'";
        $con_bd = conexion_bd(SERVIDOR, USER, PASSWD,  BASE_DATOS, $sql);
        echo json_encode($con_bd, TRUE); 
        break;
    case 'DELETE':
        if(isset($_REQUEST['id'])){
            // Parámetro como GET
            $id = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_NUMBER_INT);
            $sql ="DELETE FROM precios WHERE id = '" . $id . "'";
            $con_bd = conexion_bd(SERVIDOR, USER, PASSWD,  BASE_DATOS, $sql);
            echo json_encode($con_bd, TRUE); 
        }    
        break;
    case 'POST':
        $temporada = filter_input(INPUT_POST, 'temporada',FILTER_SANITIZE_STRING);
        $fruta = filter_input(INPUT_POST, 'fruta',FILTER_SANITIZE_STRING);
        $precio_kg = filter_input(INPUT_POST, 'precio_kg',FILTER_SANITIZE_STRING);
        $sql = "INSERT INTO precios (temporada, fruta, precio_kg) VALUES ('" . $temporada . "', '" . $fruta . "', '" . $precio_kg . "')";
        $con_bd = conexion_bd(SERVIDOR, USER, PASSWD,  BASE_DATOS, $sql);
        echo json_encode($con_db, TRUE);
        break;
    default:
        $respuesta ="Opción incorrecta!!!!";
}
