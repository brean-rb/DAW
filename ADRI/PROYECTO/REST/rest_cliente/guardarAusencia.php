<?php
include("curl_conexion.php");
session_start();

// Verificar si se enviaron las sesiones seleccionadas
if (isset($_POST['sesiones']) && !empty($_POST['sesiones'])) {

    // Recoger las horas de inicio y fin desde el formulario
    $hora_inicio = $_POST['hora_inicio'] ?? null;  // Se obtiene la hora de inicio
    $hora_fin = $_POST['hora_fin'] ?? null;        // Se obtiene la hora de fin

    // Verificar que las horas no estén vacías
    if (!$hora_inicio || !$hora_fin) {
        echo "Por favor, selecciona las horas de inicio y fin.";
        exit;
    }
    $jornadaC = false;
    if (isset($_POST["jornada_completa"])) {
        $jornadaC = true;
    }
    // Recoger las sesiones seleccionadas
    $sesionesSeleccionadas = $_POST['sesiones_profesor'];

    // Si es necesario, puedes hacer algo con las sesiones seleccionadas, por ejemplo, imprimirlas:
    // print_r($sesionesSeleccionadas); // Esto es solo para depuración

    // Preparar datos para enviar por cURL
    $params = [
        'document' => $_SESSION["documentAusente"],
        'fecha' => $_SESSION["fechaAusencia"],
        'justificada' => $_SESSION["justificada"],
        'jornada_completa' => $jornadaC,
        'sesiones' => $sesionesSeleccionadas,
        'accion' => 'registrarAusencia'
    ];

    // Realizar la petición cURL
    $response = curl_conexion(URL, 'POST', $params);

    // Decodificar la respuesta JSON
    $estado = json_decode($response, TRUE);

    // Verificar la respuesta de la petición
    if ($estado["exito"]) {
        $_SESSION['registro_exitoso'] = true;
    } elseif ($estado["error"]) {
        $_SESSION['registro_exitoso'] = false;
    } else {
        error_log("Respuesta inválida");
    }

    // Redirigir a la página de registro de ausencias
    header('Location: vistas/dashboard.php');
    exit;

} else {
    echo "No se seleccionaron sesiones.";
}
