<?php
session_start();
include('../config/config.php');

if (!isset($_SESSION['document']) || !isset($_POST['accion'])) {
    header("Location: dashboard.php");
    exit();
}

$document = $_SESSION['document'];
$accion = $_POST['accion'];

$fecha = date("Y-m-d");
$hora = date("H:i:s");

// Consultar si ya hay un registro de hoy
$sql_check = "SELECT * FROM registro_jornada 
              WHERE document = '$document' AND fecha = '$fecha' 
              ORDER BY id DESC LIMIT 1";

$result = mysqli_query($conexion_db, $sql_check);
$registro = mysqli_fetch_assoc($result);

if ($accion === 'entrada') {
    if ($registro && $registro['hora_inicio']) {
        $_SESSION['mensaje_fichaje'] = "Ya has fichado la entrada hoy.";
    } else {
        $sql_insert = "INSERT INTO registro_jornada (document, fecha, hora_inicio)
                       VALUES ('$document', '$fecha', '$hora')";
        $_SESSION['mensaje_fichaje'] = mysqli_query($conexion_db, $sql_insert)
            ? "Fichaje de entrada registrado correctamente."
            : "Error al registrar la entrada.";
    }
}

if ($accion === 'salida') {
    if (!$registro || !$registro['hora_inicio']) {
        $_SESSION['mensaje_fichaje'] = "Debes fichar la entrada antes de salir.";
    } elseif ($registro['hora_fin']) {
        $_SESSION['mensaje_fichaje'] = "Ya has fichado la salida hoy.";
    } else {
        $sql_update = "UPDATE registro_jornada 
                       SET hora_fin = '$hora' 
                       WHERE id = {$registro['id']}";
        $_SESSION['mensaje_fichaje'] = mysqli_query($conexion_db, $sql_update)
            ? "Fichaje de salida registrado correctamente."
            : "Error al registrar la salida.";
    }
}

header("Location: dashboard.php");
exit();
