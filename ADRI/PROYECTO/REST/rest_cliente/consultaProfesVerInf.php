<?php
/**
 * consultaProfesParaInformesRequest.php
 *
 * Ejecuta una petición al servicio REST para obtener la lista de profesores,
 * decodifica la respuesta JSON, la almacena en la sesión y redirige
 * a la vista de generación de informes.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 */

include("curl_conexion.php"); // Incluye la función curl_conexion(URL, método, params)
session_start();               // Inicia o reanuda la sesión PHP

/**
 * Parámetros para la llamada al servicio REST.
 *
 * @var array $params
 * @param string $params['accion'] Acción a ejecutar: 'consultaProfes'
 */
$params = [
    'accion' => 'consultaProfes'
];

/**
 * Realiza la petición al servicio REST mediante POST.
 *
 * @see curl_conexion()
 * @var string $response Respuesta JSON devuelta por el servicio.
 */
$response = curl_conexion(URL, 'POST', $params); // Realizamos la consulta usando POST

/**
 * Decodifica la respuesta JSON en un array asociativo.
 *
 * @var array $profesores Listado de profesores o clave 'error' en caso de fallo.
 */
$profesores = json_decode($response, true);

// Verificar si la API devolvió un error y guardar mensaje flash en sesión
if (isset($profesores['error'])) {
    $_SESSION['mensaje'] = [
        'type' => 'danger',
        'text' => $profesores['error']
    ];
} else {
    // Almacena el listado de profesores en la sesión para su uso posterior
    $_SESSION['profesores'] = $profesores;
}

/**
 * Recupera el listado de profesores desde la sesión.
 *
 * @var array $profesores_session Listado de profesores recuperado de $_SESSION.
 */
$profesores = $_SESSION['profesores'] ?? [];

// Redirige a la vista encargada de mostrar el formulario de generación de informes
header('Location: vistas/verInformes.php');
exit;
