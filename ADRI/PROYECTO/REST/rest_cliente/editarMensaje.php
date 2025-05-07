<?php
/**
 * editarMensajeRequest.php
 *
 * Procesa la edición de un mensaje en el chat:
 * - Recupera los datos del formulario (ID del mensaje, fecha, hora, contenido original y editado, nombre del receptor).
 * - Envía una petición PUT al servicio REST para actualizar el mensaje.
 * - Redirige de vuelta al chat con parámetros que indican éxito o error.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 *
 * @param string $_POST['nombreReceptor']    Nombre del receptor para la redirección.
 * @param string $_POST['idMensaje']         ID del mensaje a editar.
 * @param string $_POST['fecha']             Fecha original del mensaje.
 * @param string $_POST['hora']              Hora original del mensaje.
 * @param string $_POST['mensajeOriginal']   Contenido original del mensaje.
 * @param string $_POST['mensajeEditado']    Nuevo contenido para el mensaje.
 *
 * @return void Redirige al usuario a la vista de chat según el resultado.
 */

session_start();                   // Inicia o reanuda la sesión PHP
include("curl_conexion.php");      // Incluye la función curl_conexion(URL, método, params)

// Nombre del receptor para construir la URL de redirección
$nombreReceptor = $_POST['nombreReceptor'] ?? '';

$params = [
    "accion"       => "EditarMensaje",            // Acción que el servicio REST debe ejecutar
    "docentEmisor" => $_POST['idMensaje'],        // ID del mensaje que se va a editar
    "fecha"        => $_POST['fecha'],            // Fecha del mensaje original
    "hora"         => $_POST['hora'],             // Hora del mensaje original
    "mOriginal"    => $_POST['mensajeOriginal'],  // Texto original del mensaje
    "mEditado"     => $_POST['mensajeEditado']    // Texto con la edición aplicada
];

// Realiza la petición PUT al servicio REST
$respuesta = curl_conexion(URL, 'PUT', $params);
$resp      = json_decode($respuesta, true);

if (!empty($resp["exito"])) {
    // Redirige al chat indicando el profesor receptor si la edición fue exitosa
    header('Location: vistas/chat.php?profesor=' . urlencode($nombreReceptor));
} else {
    // Redirige al chat con un parámetro de error
    header("Location: vistas/chat.php?error=Error al editar");
}
exit;
