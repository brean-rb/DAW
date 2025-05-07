<?php
/**
 * consultaGuardiasPorFechaRequest.php
 *
 * Gestiona la búsqueda de guardias realizadas por fecha:
 * - Almacena la fecha de búsqueda en sesión.
 * - Realiza una petición GET al servicio REST con acción 'verGuardiasPorFecha'.
 * - Decodifica la respuesta JSON y la guarda en sesión.
 * - Redirige a la vista de consulta de ausencias por fecha.
 *
 * @package    GestionGuardias
 * @author     Adrian  
 * @license    MIT
 *
 * @param string $_GET['cargar_guardias_porFecha']  Indicador de que se solicita la carga por fecha.
 * @param string $_GET['fecha']                    Fecha para filtrar las guardias (formato 'Y-m-d').
 *
 * @return void Redirige a 'vistas/consultaAusenciaEnfecha.php' tras procesar la petición.
 */

include("curl_conexion.php");  // Incluye la función curl_conexion(URL, método, datos, headers)
session_start();               // Inicia o reanuda la sesión PHP

// Comprueba si se solicitó la carga de guardias por fecha
if (isset($_GET["cargar_guardias_porFecha"])) {
    // Guarda la fecha de falta en la sesión para mostrarla posteriormente
    $_SESSION["fechaFalta"] = $_GET['fecha'];

    // Parámetros para la petición GET al servicio REST
    $params_get = [
        'document' => $_SESSION['document'],  // Documento del usuario autenticado
        'fecha'    => $_GET['fecha'],         // Fecha de búsqueda
        'accion'   => 'verGuardiasPorFecha'   // Acción específica en el endpoint REST
    ];
    // Construye la URL completa con la query string
    $url_get = URL . '?' . http_build_query($params_get);

    // Realiza la petición GET al servidor REST
    $response = curl_conexion($url_get, 'GET');
    // Decodifica la respuesta JSON en un array asociativo
    $guardiasFecha = json_decode($response, true);

    // Marca en sesión que la búsqueda se ha realizado
    $_SESSION["busquedaGuardiasRealizada"] = true;

    // Almacena los resultados en sesión si son un array no vacío
    if (is_array($guardiasFecha) && !empty($guardiasFecha)) {
        $_SESSION["guardiasFecha"] = $guardiasFecha;
    } else {
        // En caso de respuesta inválida o vacía, guarda un array vacío y registra el error
        $_SESSION["guardiasFecha"] = [];
        error_log("Guardias vacías o respuesta inválida: " . print_r($response, true));
    }

    // Redirige a la vista que muestra las guardias filtradas por fecha
    header('Location: vistas/consultaAusenciaEnfecha.php');
    exit();
}
