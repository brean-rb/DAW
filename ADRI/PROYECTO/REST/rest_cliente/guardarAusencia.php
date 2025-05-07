<?php
/**
 * registrarAusenciaRequest.php
 *
 * Procesa el registro de una ausencia de un docente:
 * - Valida que las sesiones seleccionadas estén en formato JSON correcto.
 * - Configura los datos de la ausencia (documento, fecha, justificada, jornada completa, sesiones).
 * - Envía una petición POST con payload JSON al servicio REST para registrar la ausencia.
 * - Maneja la respuesta, almacenando en sesión el resultado y registrando errores en el log.
 * - Redirige al dashboard tras completar el proceso.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 *
 * @param array  $_POST['sesiones']         Array de sesiones codificadas en JSON.
 * @param bool   $_POST['jornada_completa'] Indicador de jornada completa (checkbox).
 * @param string $_SESSION['documentAusente'] Documento del docente ausente.
 * @param string $_SESSION['fechaSinFormat'] Fecha de la ausencia en formato original.
 * @param bool   $_SESSION['justificada']   Indicador de ausencia justificada.
 *
 * @return void  Redirige al usuario a vistas/dashboard.php o muestra error.
 */

include("curl_conexion.php");  // Incluye la función curl_conexion(URL, método, datos, headers)
session_start();               // Inicia o reanuda la sesión PHP

// Verifica que se hayan enviado y no estén vacías las sesiones seleccionadas
if (isset($_POST['sesiones']) && !empty($_POST['sesiones'])) {

    /** @var array $sesionesSeleccionadas */
    $sesionesSeleccionadas = $_POST['sesiones'];

    // Comprueba que cada elemento sea un JSON válido
    $jsonValido = true;
    foreach ($sesionesSeleccionadas as $sesionJson) {
        if (json_decode($sesionJson, true) === null) {
            $jsonValido = false;
            break;
        }
    }

    if (!$jsonValido) {
        // Si algún JSON es inválido, muestra mensaje y termina ejecución
        echo "Error: Sesiones mal formateadas.";
        exit;
    }

    // Determina si la ausencia es de jornada completa (checkbox marcado)
    /** @var bool $jornadaC */
    $jornadaC = isset($_POST['jornada_completa']);

    // Prepara el payload para la API RESTful
    $params = [
        'document'          => $_SESSION["documentAusente"],   // Documento del ausente
        'fecha'             => $_SESSION["fechaSinFormat"],    // Fecha original de la ausencia
        'justificada'       => $_SESSION["justificada"],       // Si la ausencia está justificada
        'jornada_completa'  => $jornadaC,                      // Jornada completa (true/false)
        'sesiones'          => $sesionesSeleccionadas,         // Array de sesiones seleccionadas
        'accion'            => 'registrarAusencia'             // Acción para el endpoint REST
    ];

    // Envía la petición POST con JSON al servicio (Content-Type: application/json)
    $response = curl_conexion(URL, 'POST', json_encode($params), [
        "Content-Type: application/json"
    ]);

    // Decodifica la respuesta JSON recibida
    /** @var array|null $estado */
    $estado = json_decode($response, true);

    // Manejo de errores y registro de logs
    if ($response === false || $response === "") {
        error_log("Respuesta vacía del backend.");
    } elseif (isset($estado["exito"])) {
        // Marca en sesión que el registro fue exitoso
        $_SESSION['registro_exitoso'] = true;
    } elseif (isset($estado["error"])) {
        // Marca fallo y registra el error en el log
        $_SESSION['registro_exitoso'] = false;
        error_log("Error del servidor: " . $estado["error"]);
    } else {
        // Respuesta inesperada
        error_log("Respuesta inválida del backend: " . print_r($estado, true));
    }

    // Redirige al dashboard tras procesar la ausencia
    header('Location: vistas/dashboard.php');
    exit;

} else {
    // No se enviaron sesiones: muestra mensaje de error
    echo "No se seleccionaron sesiones.";
}
