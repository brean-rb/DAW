<?php

function conex_BD($servidor, $usuario, $password, $base_datos, $consulta) {
    // Crear la conexión
    $conexion = @mysqli_connect($servidor, $usuario, $password, $base_datos);

    // Verificar si hay errores en la conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Ejecutar la consulta
    $resultado = $conexion->query($consulta);

    // Verificar si la consulta fue exitosa
    if ($resultado === false) {
        // Si hay un error en la consulta, devolver null
        return null;
    }

    // Devolver el resultado
    return $resultado;
}
