<?php
/**
 * consultarAsistenciaRequest.php
 *
 * Procesa una consulta de asistencia del profesorado:
 * - Recoge el tipo de consulta ('fecha' o 'mes'), documento y filtro de fecha/mes.
 * - Construye parámetros para la API REST (acción 'consultarAsistencia').
 * - Realiza la petición POST al servicio REST.
 * - Decodifica la respuesta y la guarda en sesión.
 * - Redirige a la vista de consulta de asistencia con un indicador de resultado.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 *
 * @param string $_POST['tipoConsulta']  Tipo de filtro: 'fecha' o 'mes'.
 * @param string $_POST['document']      Documento del profesor (opcional).
 * @param string $_POST['fecha']         Fecha concreta para filtro (formato 'Y-m-d').
 * @param string $_POST['mes']           Mes para filtro (formato 'Y-m').
 *
 * @return void Redirige a vistas/verAsistencia.php?resultado=1 con los datos guardados en sesión.
 */

session_start();                   // Inicia o reanuda la sesión PHP
include("curl_conexion.php");      // Incluye la función curl_conexion(URL, método, datos, headers)

// Recoge los parámetros del formulario
$tipoConsulta = $_POST['tipoConsulta'] ?? '';
$documento    = $_POST['document']      ?? '';
$fecha        = $_POST['fecha']         ?? '';
$mes          = $_POST['mes']           ?? '';

/**
 * Prepara los parámetros base para la petición REST.
 * - 'accion' indica la operación a realizar en el servicio.
 */
$params = [
    'accion' => 'consultarAsistencia'
];

// Añade filtro de documento si se proporcionó
if (!empty($documento)) {
    $params['document'] = $documento;
}

// Añade filtro de fecha o mes según el tipo de consulta
if ($tipoConsulta === 'fecha' && !empty($fecha)) {
    $params['fecha'] = $fecha;
} elseif ($tipoConsulta === 'mes' && !empty($mes)) {
    $params['mes'] = $mes;
}

// Realiza la petición POST al servicio REST
$response = curl_conexion(URL, 'POST', $params);

/**
 * Decodifica la respuesta JSON en un array asociativo.
 *
 * @var array|null $datosAsistencia
 */
$datosAsistencia = json_decode($response, true);

// Guarda los resultados en sesión, incluso si está vacío
$_SESSION['resultado_asistencia'] = (is_array($datosAsistencia) && !empty($datosAsistencia))
    ? $datosAsistencia
    : [];

// Redirige a la vista de verAsistencia indicando que hay un resultado
header('Location: vistas/verAsistencia.php?resultado=1');
exit;
