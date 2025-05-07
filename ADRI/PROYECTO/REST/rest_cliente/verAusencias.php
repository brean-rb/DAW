<?php
/**
 * gestionGuardiasPendientesRequest.php
 *
 * Gestiona la consulta de guardias pendientes y la asignación de una guardia:
 * - Si se recibe el parámetro GET 'cargar_guardias', realiza una petición al servicio REST
 *   para obtener las guardias pendientes del usuario y las almacena en sesión.
 * - Si se recibe el parámetro POST 'asignar', envía una petición al servicio REST
 *   para asignar la guardia seleccionada, usando un payload JSON.
 * Tras cada operación, redirige a la vista de consulta de ausencias.
 *
 * @package    GestionGuardias
 * @author     Adrian  
 * @license    MIT
 *
 * @uses curl_conexion()
 *
 * @param string $_GET['cargar_guardias'] Indicador para cargar guardias pendientes.
 * @param int    $_SESSION['document']     Documento del usuario autenticado.
 * @param int    $_POST['sesion_id']       ID de la sesión de guardia a asignar.
 * @param string $_POST['document']        Documento del profesor ausente.
 *
 * @return void Redirige siempre a vistas/consultaAusencias.php tras procesar.
 */

include("curl_conexion.php");  // Función curl_conexion(URL, método, datos, headers)
session_start();               // Inicia o reanuda la sesión PHP

/**
 * @section Consultar guardias pendientes
 * Si se solicita cargar guardias mediante GET, realiza petición GET al endpoint REST.
 */
if (isset($_GET["cargar_guardias"])) {

    // Parámteros para la petición GET al servicio REST
    $params_get = [
        'document' => $_SESSION['document'],
        'accion'   => 'verGuardias',
    ];
    // Construye la URL completa con query string
    $url_get = URL . '?' . http_build_query($params_get);

    // Realizar la petición GET
    $response = curl_conexion($url_get, 'GET');

    // Decodificar la respuesta JSON
    $guardiasPen = json_decode($response, true);

    // Verificar si la respuesta contiene un array de guardias válido
    if (is_array($guardiasPen) && isset($guardiasPen[0]) && is_array($guardiasPen[0])) {
        // Guardar las guardias pendientes en la sesión
        $_SESSION["guardiasPen"] = $guardiasPen;
    } else {
        // Limpiar la variable y registrar error en log
        unset($_SESSION["guardiasPen"]);
        error_log("Error al recibir las guardias: Respuesta inválida o no contiene sesiones válidas");
        header('Location: vistas/consultaAusencias.php');
        exit;
    }

    // Redirigir al formulario de consulta de ausencias
    header('Location: vistas/consultaAusencias.php');
    exit;
}

/**
 * @section Asignar guardia
 * Si se envía el formulario para asignar una guardia, realiza petición POST con JSON.
 */
elseif (isset($_POST["asignar"])) {

    // Preparar el payload de asignación
    $params = [
        'sesion'       => $_POST["sesion_id"],        // ID de la sesión a cubrir
        'documentAus'  => $_POST["document"],         // Documento del profesor ausente
        'document'     => $_SESSION["document"],      // Documento del usuario que cubre
        'cubierto'     => 1,                          // Indicador de guardia cubierta
        'accion'       => 'asignarGuardia'            // Acción para el endpoint REST
    ];

    // Ejecutar la petición POST enviando JSON y encabezado Content-Type
    $response = curl_conexion(
        URL,
        'POST',
        json_encode($params),
        ['Content-Type: application/json']
    );

    // Decodificar la respuesta JSON
    $resp = json_decode($response, true);

    // Redirige indicando éxito (o incluso en fallo, se mantiene success=1 según lógica existente)
    header('Location: vistas/consultaAusencias.php?success=1');
    exit;
}
