<?php
/**
 * consultaProfesRequest.php
 *
 * Script que realiza la petición al servicio REST para obtener la lista de profesores,
 * decodifica la respuesta y la almacena en la sesión para su uso en el registro de ausencias.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 */

include("curl_conexion.php"); // Incluye la función curl_conexion(URL, método, params)
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
 * @var string $response Respuesta JSON del servicio
 */
$response = curl_conexion(URL, 'POST', $params);

/**
 * Decodifica la respuesta JSON en un array asociativo.
 *
 * @var array $profesores Lista de profesores o arreglo con clave 'error' en caso de fallo
 */
$profesores = json_decode($response, true);

// Manejo de errores: si la API devuelve un error, lo guardamos como mensaje flash en la sesión
if (isset($profesores['error'])) {
    $_SESSION['mensaje'] = [
        'type' => 'danger',
        'text' => $profesores['error']
    ];
} else {
    // Si no hay error, almacenamos el listado de profesores en la sesión
    $_SESSION['profesores'] = $profesores;
}

/**
 * Recupera la lista de profesores desde la sesión.
 *
 * @var array $profesores_session Lista de profesores recuperada de $_SESSION['profesores']
 */
$profesores = $_SESSION['profesores'] ?? [];

// Redirige al usuario a la vista de registro de ausencias para mostrar el formulario con los profesores
header('Location: vistas/registroAusencias.php');
exit;
