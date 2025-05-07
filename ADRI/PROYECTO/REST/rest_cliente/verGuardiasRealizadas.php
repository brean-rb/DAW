<?php
/**
 * historialGuardiasRequest.php
 *
 * Gestiona la consulta del historial de guardias realizadas:
 * - Recoge fecha y hora opcionales desde POST.
 * - Prepara los parámetros para la API REST (acción 'historialGuardias').
 * - Envía una petición POST al servicio REST.
 * - Decodifica la respuesta JSON y almacena en sesión el historial o el error.
 * - Redirige a la vista de guardias realizadas con indicadores de resultado.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 *
 * @param bool   $_POST['cargar_guardias'] Indicador de envío del formulario.
 * @param string $_SESSION['document']     Documento del usuario autenticado.
 * @param string $_POST['fecha']           Fecha para filtrar el historial (opcional).
 * @param string $_POST['hora']            Hora para filtrar el historial (opcional).
 *
 * @return void Redirige a 'vistas/guardiasRealizadas.php' tras procesar.
 */

include("curl_conexion.php");  // Incluye la función curl_conexion(URL, método, datos, headers)
session_start();               // Inicia o reanuda la sesión PHP

// Comprueba si se ha enviado la petición de cargar guardias desde el formulario
if (isset($_POST["cargar_guardias"])) {
    // Parámetros básicos para la petición REST de historial de guardias
    $params = [
        'document' => $_SESSION['document'],   // Documento del usuario
        'accion'   => 'historialGuardias'     // Acción que solicitar al servicio
    ];

    // Si se proporcionó fecha, la añade a los parámetros
    if (!empty($_POST['fecha'])) {
        $params['fecha'] = $_POST['fecha'];
    }

    // Si se proporcionó hora, la añade a los parámetros (trim para limpiar espacios)
    if (!empty($_POST['hora'])) {
        $params['hora'] = trim($_POST['hora']);
    }

    // Realiza la petición POST al servicio REST
    $respuesta = curl_conexion(URL, 'POST', $params);

    // Decodifica la respuesta JSON en array asociativo
    $historial = json_decode($respuesta, true);

    // Si la respuesta es un array, procesa el resultado
    if (is_array($historial)) {
        if (isset($historial["error"])) {
            // Si la clave 'error' está presente, guarda el mensaje de error
            $_SESSION['historial'] = "";
            $_SESSION['error']     = $historial["error"];
        } else {
            // Si no hay error, almacena el historial en sesión y limpia errores previos
            $_SESSION['historial'] = $historial;
            unset($_SESSION['error']);
        }
    }

    // Redirige a la vista de guardias realizadas, indicando que se procesó el historial
    header('Location: vistas/guardiasRealizadas.php?historial=1&auto=0');
    exit;
}
