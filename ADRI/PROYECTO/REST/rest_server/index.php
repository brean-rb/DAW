<?php 
include("config.php");
session_start(); 

$metodo = $_SERVER['REQUEST_METHOD']; 
$recurso = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);  

if ($metodo === 'GET') {
    // Verificación de parámetros
    $document = $_GET['document'] ?? null;
    if (!$document) {
        echo json_encode(["error" => "documento requerido"]);
        exit;
    }
    // Manejo de diferentes acciones
    $accion = $_GET['accion'] ?? null;

    if ($accion === "verHorario") {
        if (isset($_GET['dia'])) {
            $dia = $_GET['dia'];

            // Consulta de horario por día
            $sql = "SELECT 
                        hg.dia_setmana,
                        hg.hora_desde,
                        hg.hora_fins,
                        c.nom_cas AS asignatura,
                        hg.grup AS grupo,
                        hg.aula AS aula,
                        hg.sessio_orde AS sesion
                    FROM horari_grup hg
                    LEFT JOIN continguts c ON c.codi = hg.contingut
                    WHERE hg.docent = '$document'
                    AND hg.dia_setmana = '$dia'
                    ORDER BY FIELD(hg.dia_setmana, 'L', 'M', 'X', 'J', 'V'), hg.hora_desde";

            $resultado_horario = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);

            if (is_array($resultado_horario)) {
                echo json_encode($resultado_horario);
            } else {
                echo json_encode(["error" => "No se encontraron datos de horario"]);
            }
        } else {
            echo json_encode(["error" => "Día no proporcionado"]);
        }
    } elseif ($accion === "verGuardias") {
        $fecha = date('Y-m-d');  // Obtener la fecha de hoy

        // Consulta para obtener las guardias
        $sql = "SELECT sesion, aula, grupo, asignatura, document,cubierto FROM ausencias WHERE fecha = '$fecha'";
        $respuesta = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);
        if (is_array($respuesta)) {
            echo json_encode($respuesta);  // Devolver la respuesta con las guardias
        } else {
            echo json_encode(["error" => "No se encontraron guardias para hoy"]);
        }
    }
}
elseif ($metodo === 'POST') {
   
    $accion = $_POST['accion'] ?? null;
    if ($accion === "InicioSesion") {
        // Manejo de inicio de sesión
        $document = $_POST['document'] ?? null;         
        $password = $_POST['password'] ?? null;          

        if ($document && $password) {             
            $sql = "SELECT * FROM usuarios WHERE document = '$document'";             
            $resultado = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);              

            if (is_array($resultado)) {                 
                $sqlNom = "SELECT CONCAT(nom,' ',cognom1,' ',cognom2) FROM docent WHERE document = '$document'";                 
                $resultadoNom = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sqlNom);                  

                if (is_array($resultadoNom)) {                     
                    $nombre_profesor = $resultadoNom[0][0];                  
                } else {                     
                    $nombre_profesor = "Desconocido";                 
                }                  

                if (password_verify($password, $resultado[0][2])) {                     
                    $fechaHora = date('d-m-Y H:i:s');                     
                    $linea = "$fechaHora | Éxito | DNI: $document | Profesor: $nombre_profesor | Log In(Entrada)\n";                     
                    $archivo = fopen("registroAccesos.txt", "a");                     
                    if ($archivo) {                         
                        fwrite($archivo, $linea);                         
                        fclose($archivo);                     
                    } else {                         
                        error_log("Error al abrir el archivo");                     
                    }                     
                    echo json_encode(["loggeado" => true, "nombre" => $nombre_profesor, "document" => $resultado[0][1], "rol" => $resultado[0][3]]);                 
                } else {                     
                    $fechaHora = date('d-m-Y H:i:s');                     
                    $linea = "$fechaHora | Fallo | DNI: $document | Profesor: $nombre_profesor | Log In(Entrada)\n";                     
                    $archivo = fopen("registroAccesos.txt", "a");                     
                    if ($archivo) {                         
                        fwrite($archivo, $linea);                         
                        fclose($archivo);                     
                    } else {                         
                        error_log("Error al abrir el archivo");                     
                    }                     
                    echo json_encode(["loggeado" => false, "error" => "Contraseña errónea"]);                 
                }              
            } else {                 
                echo json_encode(["loggeado" => false, "error" => "Usuario inexistente"]);             
            }          
        } else {             
            echo json_encode(["loggeado" => false, "error" => "Faltan datos del usuario"]);         
        } 
    } elseif ($accion === "ficharEntrada" || $accion === "ficharSalida") {
        // Manejo de fichaje de entrada o salida
        $document = $_POST['document'] ?? null;         
        $fecha = date('Y-m-d');  // Obtén la fecha actual
        $hora_entrada = $_POST['hora_entrada'] ?? null;
        $hora_salida = $_POST['hora_salida'] ?? null;

        if ($document) {
            if ($accion === "ficharEntrada") {
                // Comprobar si ya fichó la entrada hoy
                $sqlCheckEntrada = "SELECT * FROM registro_jornada WHERE document = '$document' AND fecha = '$fecha' AND hora_entrada IS NOT NULL";
                $resultadoEntrada = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sqlCheckEntrada);

                if (is_array($resultadoEntrada) && count($resultadoEntrada) > 0) {
                    // Si ya existe un registro de entrada
                    echo json_encode(["error" => "Ya has fichado entrada hoy"]);
                } else {
                    // Fichaje de entrada
                    if ($hora_entrada) {
                        $sql = "INSERT INTO registro_jornada (document, fecha, hora_entrada) VALUES ('$document', '$fecha', '$hora_entrada')";
                        $resultFicharEnt = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);

                        if ($resultFicharEnt > 0) {
                            echo json_encode(["exito" => "Entrada registrada correctamente"]);
                        } else {
                            echo json_encode(["error" => "Error al registrar la entrada"]);
                        }
                    } else {
                        echo json_encode(["error" => "Falta la hora de entrada"]);
                    }
                }
            } elseif ($accion === "ficharSalida") {
                // Comprobar si existe un registro de entrada para poder registrar la salida
                $sqlCheckSalida = "SELECT * FROM registro_jornada WHERE document = '$document' AND fecha = '$fecha' AND hora_entrada IS NOT NULL AND hora_salida IS NULL";
                $resultadoSalida = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sqlCheckSalida);

                if (is_array($resultadoSalida) && count($resultadoSalida) > 0) {
                    // Si existe un registro de entrada, actualizamos con la salida
                    if ($hora_salida) {
                        $sqlUpdateSalida = "UPDATE registro_jornada SET hora_salida = '$hora_salida' WHERE document = '$document' AND fecha = '$fecha' AND hora_salida IS NULL";
                        $resultFicharSal = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sqlUpdateSalida);

                        if ($resultFicharSal > 0) {
                            echo json_encode(["exito" => "Salida registrada correctamente"]);
                        } else {
                            echo json_encode(["error" => "Error al registrar la salida"]);
                        }
                    } else {
                        echo json_encode(["error" => "Falta la hora de salida"]);
                    }
                } else {
                    echo json_encode(["error" => "No se ha fichado entrada hoy o ya se registró la salida"]);
                }
            } else {
                echo json_encode(["error" => "Acción no válida"]);
            }
        } else {
            echo json_encode(["error" => "Faltan datos del usuario"]);
        }
    } elseif ($accion === "consultaProfes") {
        // Consulta para obtener todos los profesores de la tabla 'docent'
        $sql = "SELECT document, CONCAT(nom, ' ', cognom1, ' ', cognom2) AS nombre_completo FROM docent";
        $resultado = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);
    
        // Verificar si la consulta fue exitosa
        if (is_array($resultado)) {
            echo json_encode($resultado);  // Devolver los datos de los profesores
        } else {
            echo json_encode(["error" => "No se encontraron docentes"]);  // Error en caso de no encontrar docentes
        }
    } elseif ($accion === "verSesiones") {
        $document = $_POST['document'];
        $dia = $_POST['dia'];

        $sql = "SELECT 
            hg.dia_setmana,
            hg.hora_desde,
            hg.hora_fins,
            c.nom_cas AS asignatura,
            hg.grup AS grupo,
            hg.aula AS aula,
            hg.sessio_orde AS sesion
        FROM horari_grup hg
        LEFT JOIN continguts c ON c.codi = hg.contingut
        WHERE hg.docent = '$document'
         AND hg.dia_setmana = '$dia'
        ORDER BY FIELD(hg.dia_setmana, 'L', 'M', 'X', 'J', 'V'), hg.hora_desde";

        $resultado_horario = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);
        if (is_array($resultado_horario)) {
            echo json_encode($resultado_horario);
        } else {
            echo json_encode(["error" => "No se encontraron datos de horario"]);
        }
    } elseif ($accion === "registrarAusencia") { 
        $fecha = $_POST['fecha'] ?? null; 
        $sesionesSeleccionadas = $_POST['sesiones'];  // Sesiones seleccionadas (valores de los checkboxes)
        $resultadoIn = true; 
        if (isset($sesionesSeleccionadas)) {
        foreach ($sesionesSeleccionadas as $index => $sesion) {
            $hora_inicio = $sesion[1];
            $hora_fin = $sesion[2];
            $dia = $sesion[0];
            $aula = $sesion[5];
            $grupo = $sesion[4];
            $asignatura = $sesion[3];
            $sesion = $sesion[6];
    
            $document = $_POST['document'] ?? null;         
            $justificada = $_POST['justificada'] ?? null;         
            $jornada_completa = $_POST["jornada_completa"] ?? null;
    
            // Ejecutar la consulta
            $sql = "INSERT INTO ausencias (hora_inicio, hora_fin, dia, aula, grupo, asignatura, sesion, document, justificada, jornada_completa, fecha) 
            VALUES ('$hora_inicio', '$hora_fin', '$dia','$aula','$grupo','$asignatura','$sesion','$document','$justificada','$jornada_completa', '$fecha')";
            
            // Comprobar si la consulta fue exitosa
            $resultadoConsulta = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);
    
            // Si alguna consulta falla, no continuar
            if ($resultadoConsulta === false) {
                $resultadoIn = false;  // Marcar que hubo un error en alguna consulta
                error_log("Error al ejecutar la consulta SQL: " . $sql);
                break;  // Salir del bucle si hay un error
            }
        }
        // Verificar si todas las consultas fueron exitosas
        if ($resultadoIn) {
            echo json_encode(["exito" => "Entrada registrada correctamente"]);
        } else {
            error_log("Error en la consulta o no se insertaron registros.");
            echo json_encode(["error" => "Error al registrar la entrada"]);
        }
        }else{
            error_log("No definido");
        }
    }elseif ($accion === "asignarGuardia") {
        $fecha = date('Y-m-d');  // Obtener la fecha de hoy
        parse_str(file_get_contents("php://input"), $datos);
        $sesionAus = $datos["sesion"];
        $documentAus = $datos["documentAus"];
        $documentCubierto = $datos["document"];
        $cubiertoAus = $datos["cubierto"];
        // Consulta para obtener las guardias
        $sql = "UPDATE ausencias SET cubierto = '$cubiertoAus' WHERE sesion = '$sesionAus' AND document = '$documentAus'";
        $resultadoAsignar = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);
        $funcional = false;
        if ($resultadoAsignar > 0) {

            $sql = "SELECT * FROM ausencias WHERE cubierto = 1";
            $resinsertinforme = conexion_bd(SERVIDOR,USER,PASSWD,BASE_DATOS,$sql);
            if (is_array($resinsertinforme)) {
                $hora_inicio = $resinsertinforme[0][1];
                $hora_fin = $resinsertinforme[0][2];
                $dia = $resinsertinforme[0][3];
                $aula = $resinsertinforme[0][4];
                $grupo = $resinsertinforme[0][5];
                $asignatura = $resinsertinforme[0][6];
                $sesion = $resinsertinforme[0][7];
                $document = $resinsertinforme[0][8];
                $fecha = $resinsertinforme[0][11];
                $sqlInforme = "INSERT INTO registro_guardias (fecha, docente_ausente, docente_guardia, aula, grupo, asignatura, sesion_orden, dia_semana, hora_inicio, hora_fin) 
                               VALUES ('$fecha', '$document', '$documentCubierto', '$aula', '$grupo', '$asignatura', '$sesion', '$dia', '$hora_inicio', '$hora_fin')";
                $resultadoInforme = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sqlInforme);

                if ($resultadoInforme > 0) {
                    $funcional = true;
                }
            }
        }
        if ($funcional) {
            echo json_encode(["exito" => "Guardia asignada correctamente"]);
        }else
        echo json_encode(["error" => "Error al asignar la guardia"]);
    }
    elseif ($accion === "historialGuardias") {
        $document = $_POST['document'];
        $sql = "SELECT * FROM registro_guardias WHERE docente_guardia = '$document'";
        $historialGuard = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);
        if (is_array($historialGuard)) {
            echo json_encode($historialGuard);
        } else {
            echo json_encode(["error" => "No se encontraron registros de guardias"]);
        }
    }
}
    

elseif ($metodo === 'PUT') {         
    // Por implementar         
} 
elseif ($metodo === 'DELETE') {         
    // Por implementar         
} 
else {         
    echo json_encode(["error" => "Opción incorrecta!!!!"]); 
}
