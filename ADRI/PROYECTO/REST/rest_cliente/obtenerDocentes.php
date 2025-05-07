<?php
/**
 * consultaProfesRegistroAusencias.php
 *
 * Obtiene la lista de profesores desde el servicio REST y la almacena en sesión
 * para su uso en el formulario de registro de ausencias.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 *
 * @return void Redirige inmediatamente a vistas/registroAusencias.php tras guardar datos en sesión.
 */

include("curl_conexion.php"); // Incluye la función curl_conexion(URL, método, datos, headers)
session_start();              // Inicia o reanuda la sesión PHP

/**
 * Parámetros para la petición al servicio REST.
 *
 * @var array $params
 * @param string $params['accion'] Acción a ejecutar en el servidor: 'consultaProfes'
 */
$params = [
    'accion' => 'consultaProfes'
];

/**
 * Realiza la petición POST al servicio REST para obtener profesores.
 *
 * @see curl_conexion()
 * @var string|false $response Respuesta JSON o false en caso de error.
 */
$response = curl_conexion(URL, 'POST', $params); // Usamos POST para la consulta

/**
 * Decodifica la respuesta JSON en array asociativo.
 *
 * @var array $profesores
 */
$profesores = json_decode($response, true);

// Manejo de errores: si la API retorna clave 'error', lo guarda como mensaje flash
if (isset($profesores['error'])) {
    $_SESSION['mensaje'] = [
        'type' => 'danger',
        'text' => $profesores['error']
    ];
} else {
    // Almacena el listado de profesores en sesión para el formulario de ausencias
    $_SESSION['profesores'] = $profesores;
}

// Redirige al formulario de registro de ausencias
header("Location: vistas/registroAusencias.php");
exit;
