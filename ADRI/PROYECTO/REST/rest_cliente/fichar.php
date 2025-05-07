<?php
/**
 * ficharRequest.php
 *
 * Gestiona el fichaje de entrada y salida del usuario autenticado.
 * - Para entrada: envía la hora actual al servicio REST con acción 'ficharEntrada'.
 * - Para salida: envía la hora actual al servicio REST con acción 'ficharSalida'.
 * Los mensajes de resultado (éxito o error) se guardan en la sesión y luego redirige
 * al dashboard.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 *
 * @uses curl_conexion   Función para realizar peticiones cURL al servidor REST.
 */

session_start();
/** @return void Inicia o reanuda la sesión PHP. */

include("curl_conexion.php");
/** @return void Incluye la función curl_conexion(URL, método, params). */

/**
 * Procesa el fichaje de entrada.
 *
 * @param bool $_POST['fentrada'] Indicador de que se ha pulsado el botón de entrada.
 * @var string $document       Documento del usuario desde la sesión.
 * @var string $fecha          Fecha actual en formato 'Y-m-d'.
 * @var string $hora_entrada   Hora de entrada actual en formato 'H:i:s'.
 * @var array  $params         Parámetros enviados en la petición.
 * @var string $response       Respuesta JSON recibida del servidor.
 * @var array  $resp           Array resultante de json_decode().
 *
 * @return void Redirige a vistas/dashboard.php tras procesar la petición.
 */
if (isset($_POST['fentrada'])) {
    // Datos para la petición POST
    $document      = $_SESSION['document'];
    $fecha         = date('Y-m-d');
    $hora_entrada  = date('H:i:s');

    // Parámetros para la API RESTful
    $params = [
        'document'      => $document,
        'fecha'         => $fecha,
        'hora_entrada'  => $hora_entrada,
        'accion'        => 'ficharEntrada'
    ];

    // Realizar la petición cURL al servidor
    $response = curl_conexion(URL, 'POST', $params);
    $resp     = json_decode($response, true);

    // Comprobar si la respuesta es exitosa
    if (isset($resp['exito'])) {
        $_SESSION['mensaje'] = [
            'type' => 'success',
            'text' => $resp['exito']
        ];
    } elseif (isset($resp['error'])) {
        $_SESSION['mensaje'] = [
            'type' => 'danger',
            'text' => $resp['error']
        ];
    }

    // Redirigir a la página de dashboard
    header("Location: vistas/dashboard.php");
    exit();
}

/**
 * Procesa el fichaje de salida.
 *
 * @param bool $_POST['fsalida'] Indicador de que se ha pulsado el botón de salida.
 * @var string $document      Documento del usuario desde la sesión.
 * @var string $fecha         Fecha actual en formato 'Y-m-d'.
 * @var string $hora_salida   Hora de salida actual en formato 'H:i:s'.
 * @var array  $params        Parámetros enviados en la petición.
 * @var string $response      Respuesta JSON recibida del servidor.
 * @var array  $resp          Array resultante de json_decode().
 *
 * @return void Redirige a vistas/dashboard.php tras procesar la petición.
 */
if (isset($_POST['fsalida'])) {
    // Datos para la petición POST
    $document     = $_SESSION['document'];
    $fecha        = date('Y-m-d');
    $hora_salida  = date('H:i:s');

    // Parámetros para la API RESTful
    $params = [
        'document'     => $document,
        'fecha'        => $fecha,
        'hora_salida'  => $hora_salida,
        'accion'       => 'ficharSalida'
    ];

    // Realizar la petición cURL al servidor
    $response = curl_conexion(URL, 'POST', $params);
    $resp     = json_decode($response, true);

    // Comprobar si la respuesta es exitosa
    if (isset($resp['exito'])) {
        $_SESSION['mensaje'] = [
            'type' => 'success',
            'text' => $resp['exito']
        ];
    } elseif (isset($resp['error'])) {
        $_SESSION['mensaje'] = [
            'type' => 'danger',
            'text' => $resp['error']
        ];
    }

    // Redirigir a la página de dashboard
    header("Location: vistas/dashboard.php");
    exit();
}
