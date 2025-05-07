<?php
/**
 * generarInformeRequest.php
 *
 * Procesa la generación de un informe de faltas según el tipo seleccionado:
 * - Recupera el tipo de informe y sus parámetros (día, semana, mes, trimestre, docente o curso).
 * - Construye la URL con query string para la API REST usando GET.
 * - Decodifica la respuesta JSON y la almacena en la sesión.
 * - Redirige a la vista de resultados o de selección de informes según corresponda.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 *
 * @param string|null $_GET['tipoInforme']   Tipo de informe: 'dia', 'semana', 'mes', 'trimestre', 'docent', 'curs'.
 * @param string|null $_GET['dia']           Fecha concreta para informe por día (formato 'Y-m-d').
 * @param string|null $_GET['semana']        Fecha dentro de la semana para informe semanal (formato 'Y-m-d').
 * @param string|null $_GET['mes']           Mes para informe mensual (formato 'Y-m').
 * @param string|null $_GET['trimestre']     Número de trimestre ('1', '2' o '3').
 * @param string|null $_GET['docent']        ID de docente para informe por docente.
 *
 * @return void Redirige a 'vistas/verResultados.php' con los datos del informe en sesión,
 *              o vuelve a 'vistas/verInformes.php' con un mensaje de alerta si no hay datos.
 */

session_start();                    // Inicia o reanuda la sesión PHP
include("curl_conexion.php");       // Incluye la función curl_conexion(URL, método, params)

// Obtiene el tipo de informe solicitado
$tipo = $_GET['tipoInforme'] ?? null;

/**
 * Parámetros base para la llamada a la API REST.
 * - 'document': documento del usuario autenticado.
 * - 'accion'  : acción 'generarInforme' en el servidor.
 * - 'tipo'    : tipo de informe seleccionado.
 */
$params = [
    'document' => $_SESSION['document'],
    'accion'   => 'generarInforme',
    'tipo'     => $tipo
];

// Añade el parámetro específico según el tipo de informe
switch ($tipo) {
    case 'dia':
        $params['fecha']      = $_GET['dia']      ?? '';
        break;
    case 'semana':
        $params['semana']     = $_GET['semana']   ?? '';
        break;
    case 'mes':
        $params['mes']        = $_GET['mes']      ?? '';
        break;
    case 'trimestre':
        $params['trimestre']  = $_GET['trimestre'] ?? '';
        break;
    case 'docent':
        $params['docente']    = $_GET['docent']    ?? '';
        break;
    case 'curs':
        $params['curso']      = '2025'; // Informe de todo el curso
        break;
    default:
        // Tipo inválido: muestra mensaje y detiene ejecución
        echo "Error: tipo de informe no válido.";
        exit;
}

// Construye la URL con query string y realiza la petición GET
$url      = URL . '?' . http_build_query($params);
$response = curl_conexion($url, 'GET');

/** Decodifica la respuesta JSON en array asociativo. */
$data = json_decode($response, true);

// Si hay datos válidos, los guarda en sesión y redirige a la vista de resultados
if (!empty($data) && is_array($data)) {
    $_SESSION['resultado_informe'] = $data;
    $_SESSION['tipo_informe']      = $tipo;
    header('Location: vistas/verResultados.php');
    exit;
} else {
    // No se encontraron resultados: prepara un mensaje de alerta y redirige
    $_SESSION['alert_message'] = 'No se encontraron resultados para la consulta.';
    header('Location: vistas/verInformes.php');
    exit;
}
