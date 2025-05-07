<?php
/**
 * consultaProfesParaAsistencia.php
 *
 * Ejecuta una petición al servicio REST para obtener la lista de profesores,
 * la almacena en la sesión y redirige a la vista de consulta de asistencia.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 */

include("curl_conexion.php");  // Incluye la función curl_conexion(URL, método, params)
session_start();               // Inicia o reanuda la sesión PHP

/**
 * Parámetros para la petición al servicio REST.
 *
 * @var array $params
 * @param string $params['accion'] Acción a ejecutar: 'consultaProfes'
 */
$params = [
    'accion' => 'consultaProfes'
];

/**
 * Realiza la llamada al servicio REST usando método POST.
 *
 * @see curl_conexion()
 * @var string $response Respuesta JSON recibida del servicio
 */
$response = curl_conexion(URL, 'POST', $params); // Realizamos la consulta usando POST

/**
 * Decodifica la respuesta JSON en un array asociativo.
 *
 * @var array $profesores Listado de profesores o arreglo con clave 'error'
 */
$profesores = json_decode($response, true);

// Verifica si la API devolvió un error y guarda un mensaje flash en sesión
if (isset($profesores['error'])) {
    $_SESSION['mensaje'] = [
        'type' => 'danger',
        'text' => $profesores['error']
    ];
} else {
    // Si no hubo error, almacena el listado de profesores en la sesión
    $_SESSION['profesores'] = $profesores;
}

/**
 * Recupera el listado de profesores desde la sesión para su uso en la vista.
 *
 * @var array $profesores_session
 */
$profesores = $_SESSION['profesores'] ?? [];

// Redirige a la vista que muestra la consulta de asistencia
header('Location: vistas/verAsistencia.php');
exit;
