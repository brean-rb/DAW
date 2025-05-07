<?php
/**
 * curl_conexion.php
 *
 * Define la URL base del servicio REST y proporciona la función curl_conexion
 * para ejecutar peticiones HTTP (GET, POST, PUT, DELETE, PATCH, OPTIONS)
 * al servidor REST, manejando automáticamente la codificación de datos
 * y los encabezados según el método.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 */

/**
 * Constante que define la URL base del servicio REST.
 */
DEFINE("URL", "http://localhost/GestionGuardias/PROYECTO/REST/rest_server/index.php");

/**
 * Realiza una petición HTTP al servicio REST usando cURL.
 *
 * @param string       $url     URL completa del endpoint al que realizar la petición.
 * @param string       $metodo  Método HTTP a utilizar ('GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS').
 * @param array|string $datos   (Opcional) Datos a enviar en el cuerpo de la petición. Array para formularios o JSON; string para RAW.
 * @param array|null   $headers (Opcional) Array de encabezados HTTP adicionales en formato ['Header: valor'].
 *
 * @return string|false Respuesta del servidor como cadena, o false si ocurre un error de cURL.
 */
function curl_conexion($url, $metodo = 'GET', $datos = null, $headers = null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Normaliza el método a mayúsculas
    $metodo = strtoupper($metodo);

    // Para métodos que no son GET ni POST (PUT, DELETE, PATCH, OPTIONS)
    if (in_array($metodo, ['PUT','DELETE','PATCH','OPTIONS'])) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $metodo);

        if (!empty($datos)) {
            // Si los datos vienen como array, los codifica a JSON
            if (is_array($datos)) {
                $payload = json_encode($datos);
                $headers[] = 'Content-Type: application/json';
            } else {
                // Si es string (urlencoded o RAW), lo envía tal cual
                $payload = $datos;
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        }
    }
    // Para método POST
    elseif ($metodo === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        if (!empty($datos)) {
            if (is_array($datos)) {
                // POST tradicional application/x-www-form-urlencoded
                $payload = http_build_query($datos);
                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            } else {
                $payload = $datos;
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        }
    }
    // Para GET no se necesita configuración de cuerpo

    // Si se proporcionan headers, los añade a la petición
    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    // Ejecuta la petición
    $respuesta = curl_exec($ch);
    if (curl_errno($ch)) {
        // Registra el error en el log de errores
        error_log("Error cURL ({$metodo}): " . curl_error($ch));
        curl_close($ch);
        return false;
    }

    curl_close($ch);
    return $respuesta;
}
