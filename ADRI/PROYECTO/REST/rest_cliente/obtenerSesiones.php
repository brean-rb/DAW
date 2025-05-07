<?php
/**
 * obtenerSesionesDocenteRequest.php
 *
 * Procesa la selección de fecha y documento para registrar una ausencia:
 * - Guarda en sesión el docente ausente y la fecha (original y formateada).
 * - Determina si la ausencia está justificada según el motivo.
 * - Calcula la letra del día de la semana de la fecha seleccionada.
 * - Realiza una petición al servicio REST (acción 'verSesiones') para obtener
 *   las sesiones del docente en esa fecha.
 * - Almacena las sesiones en sesión y redirige a la vista de horario de ausencias.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 *
 * @param string      $_POST['document'] Documento del docente ausente.
 * @param string      $_POST['fecha']    Fecha de la ausencia en formato 'Y-m-d'.
 * @param string|null $_POST['motivo']   Motivo de la ausencia (opcional).
 *
 * @return void     Redirige a 'vistas/horarioAusente.php' una vez procesado.
 */

session_start();                   // Inicia o reanuda la sesión PHP
include("curl_conexion.php");      // Incluye la función curl_conexion(URL, método, datos, headers)

// Marca por defecto que la ausencia no está justificada
$justificada = false;

/**
 * Valida que se hayan recibido 'fecha' y 'document' por POST.
 */
if (isset($_POST["fecha"], $_POST["document"])) {
    // Asigna el documento del docente y lo almacena en sesión
    $document = $_POST["document"];
    $_SESSION["documentAusente"] = $document;
    
    // Guarda la fecha original y la fecha formateada en sesión
    $_SESSION["fechaSinFormat"] = $_POST["fecha"];
    $_SESSION["fechaAusencia"]  = date('d-m-Y', strtotime($_POST["fecha"]));
    
    // Si se proporcionó un motivo, marca la ausencia como justificada
    if (!empty($_POST["motivo"])) {
        $justificada = true;
    }
    $_SESSION["justificada"] = $justificada;

    // Mapa de días en inglés a primeras letras en español
    $dayMap = [
        'Monday'    => 'L',
        'Tuesday'   => 'M',
        'Wednesday' => 'X',
        'Thursday'  => 'J',
        'Friday'    => 'V',
        'Saturday'  => 'S',
        'Sunday'    => 'D'
    ];
    // Determina la letra del día según la fecha seleccionada
    $dia = $dayMap[date('l', strtotime($_POST["fecha"]))];

    // Construye parámetros para la petición REST
    $params = [
        'document' => $document,
        'dia'      => $dia,
        'accion'   => 'verSesiones'
    ];

    // Realiza la petición POST al servicio REST
    $response = curl_conexion(URL, 'POST', $params);
    $sesiones = json_decode($response, true);

    // Almacena en sesión las sesiones recibidas, si no hay error
    $_SESSION["sesiones_profesor"] = (
        !empty($sesiones)
        && is_array($sesiones)
        && (!isset($sesiones["error"]) || !$sesiones["error"])
    ) ? $sesiones : [];

    // Redirige a la vista que muestra el horario con las sesiones de ausencia
    header("Location: vistas/horarioAusente.php");
    exit;
}
