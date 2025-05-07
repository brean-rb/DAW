<?php
/**
 * inicioSesionRequest.php
 *
 * Gestiona el proceso de inicio de sesión y carga de horario del usuario:
 * 1) Sanitiza y formatea la contraseña introducida para ajustarse a 'd/m/Y'.
 * 2) Realiza petición POST al servicio REST para verificar credenciales (acción 'InicioSesion').
 * 3) Si el login es exitoso, guarda datos de usuario en $_SESSION.
 * 4) Calcula la letra del día actual y realiza petición GET para obtener el horario del día (acción 'verHorario').
 * 5) Almacena las sesiones del día en sesión o marca alerta si no hay sesiones.
 * 6) Redirige al dashboard en todos los casos, o de regreso a login si falla la autenticación.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 *
 * @param string $_POST['document']  Documento del usuario (identificador).
 * @param string $_POST['password']  Contraseña ingresada (formato libre o con separadores).
 *
 * @return void Redirige a vistas/dashboard.php si el login y carga de horario son exitosos,
 *              o a login.php en caso de error de autenticación.
 */

session_start();                      // Inicia o reanuda sesión PHP
include("curl_conexion.php");         // Incluye la función curl_conexion(URL, método, datos, headers)

if (isset($_POST["validar"])) {
    // Validar que se enviaron documento y contraseña
    if (isset($_POST["document"]) && isset($_POST["password"])) {
        // Sanitiza entrada
        $document         = filter_input(INPUT_POST, "document", FILTER_SANITIZE_SPECIAL_CHARS);
        $passwordInput    = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        // Elimina caracteres no numéricos para intentar DDMMYYYY o YYYYMMDD
        $limpio = preg_replace('/[^0-9]/', '', $passwordInput);

        // Si quedan 8 dígitos, determinamos orden y formateamos a 'd/m/Y'
        if (strlen($limpio) === 8) {
            if (substr($limpio, 0, 4) > 1900) {
                // Caso YYYYMMDD
                $anio = substr($limpio, 0, 4);
                $mes  = substr($limpio, 4, 2);
                $dia  = substr($limpio, 6, 2);
            } else {
                // Caso DDMMYYYY
                $dia  = substr($limpio, 0, 2);
                $mes  = substr($limpio, 2, 2);
                $anio = substr($limpio, 4, 4);
            }
            $password = "$dia/$mes/$anio";
        } else {
            // Si no, intentamos parsear formatos con separadores
            $password = $passwordInput;
            $formatos = ['d-m-Y', 'Y-m-d', 'd/m/Y', 'Y/m/d'];
            foreach ($formatos as $formato) {
                $fecha = DateTime::createFromFormat($formato, $passwordInput);
                if ($fecha && $fecha->format($formato) === $passwordInput) {
                    $password = $fecha->format('d/m/Y');
                    break;
                }
            }
        }

        // Prepara parámetros para la petición de login
        $params = [
            'document' => $document,
            'password' => $password,
            'accion'   => 'InicioSesion'
        ];

        // Llama al servicio REST para iniciar sesión
        $response = curl_conexion(URL, "POST", $params);
        $resp     = json_decode($response, true);

        // Si la respuesta indica login exitoso
        if ($resp && isset($resp["loggeado"]) && $resp["loggeado"] === true) {
            // Guardar datos de usuario en sesión
            $_SESSION["nombre"]   = $resp["nombre"];
            $_SESSION["document"] = $resp["document"];
            $_SESSION["rol"]      = $resp["rol"];

            // Mapeo día de la semana en letra
            $dayMap = [
                'Monday'    => 'L',
                'Tuesday'   => 'M',
                'Wednesday' => 'X',
                'Thursday'  => 'J',
                'Friday'    => 'V',
                'Saturday'  => 'S',
                'Sunday'    => 'D'
            ];
            $dia = $dayMap[date('l')]; // date('l') devuelve el día en inglés

            // Prepara parámetros para obtener el horario del día
            $params_get = [
                'document' => $_SESSION["document"],
                'dia'      => $dia,
                'accion'   => 'verHorario'
            ];
            $url_get  = URL . '?' . http_build_query($params_get);
            $resp_get = curl_conexion($url_get, "GET");
            $sesiones = json_decode($resp_get, true);

            // Almacena sesiones del día o alerta si no hay
            if (isset($sesiones) && !empty($sesiones) && is_array($sesiones)) {
                $_SESSION["sesiones_hoy"] = $sesiones;
            } else {
                unset($_SESSION["sesiones_hoy"]);
                $_SESSION["alertSinSesiones"] = "No hay sesiones";
            }

            // Redirige al dashboard tras login y carga de horario
            header("Location: vistas/dashboard.php");
            exit;

        } else {
            // Login fallido: guarda mensaje de error en sesión y redirige a login
            $_SESSION["error_login"] = $resp["error"] ?? "No validado";
            header("Location: login.php");
            exit;
        }
    }
}
