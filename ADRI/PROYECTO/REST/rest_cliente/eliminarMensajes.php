<?php
/**
 * borrarMensajesRequest.php
 *
 * Procesa la eliminación de uno o varios mensajes en el chat:
 * - Recupera los datos del formulario (mensajes seleccionados y nombre del receptor).
 * - Envía una petición DELETE al servicio REST para borrar los mensajes.
 * - Redirige de vuelta al chat con parámetros que indican éxito o error.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 *
 * @param string   $_POST['nombreReceptor']  Nombre del receptor para la redirección.
 * @param array    $_POST['seleccionados']   Array de mensajes a borrar; cada elemento es un subarray con campos fecha, hora y mensajeOriginal.
 *
 * @return void Redirige al usuario a la vista de chat según el resultado.
 */

session_start();                   // Inicia o reanuda la sesión PHP
include("curl_conexion.php");      // Incluye la función curl_conexion(URL, método, params)

// Nombre del receptor para construir la URL de redirección
$nombreReceptor = $_POST['nombreReceptor'] ?? '';

$params = [
    "accion"    => "BorrarMensaje",       // Acción que el servicio REST debe ejecutar
    "mensajes"  => $_POST["seleccionados"] // Array de mensajes seleccionados para borrar
];

/**
 * Realiza la petición DELETE al servicio REST.
 * 
 * @see curl_conexion()
 * @var string|false $respuesta Respuesta JSON del servicio, o false en caso de error.
 */
$respuesta = curl_conexion(URL, 'DELETE', $params);

/**
 * Decodifica la respuesta JSON en un array asociativo.
 *
 * @var array|null $resp Resultado decodificado; puede ser null si JSON inválido.
 */
$resp = json_decode($respuesta, true);

if (!empty($resp["exito"])) {
    // Redirige al chat indicando el profesor receptor si la eliminación fue exitosa
    header('Location: vistas/chat.php?profesor=' . urlencode($nombreReceptor));
} else {
    // Redirige al chat con un parámetro de error
    header("Location: vistas/chat.php?error=Error al borrar");
}
exit;
