<?php 
include("config.php");
session_start(); 

$metodo = $_SERVER['REQUEST_METHOD']; 
$recurso = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);  

if ($metodo === 'GET') {
    $document = $_GET['document'] ?? null;      

    if (!$document) {         
        echo json_encode(["error" => "documento requerido"]);     
        exit;    
    }

    if (isset($_GET['dia'])) {
        $dia = $_GET['dia'];

        $sql = "SELECT 
        hg.dia_setmana,
        hg.hora_desde,
        hg.hora_fins,
        c.nom_cas AS asignatura,
        hg.grup AS grupo,
        hg.aula AS aula
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
        // Si no se envía 'dia', se asume que se quiere obtener el horario del día actual
        $letras_dias = [             
            'Monday'    => 'L',             
            'Tuesday'   => 'M',             
            'Wednesday' => 'X',             
            'Thursday'  => 'J',             
            'Friday'    => 'V',             
            'Saturday'  => 'S',             
            'Sunday'    => 'D'         
        ];          

        $dia_hoy = date('l'); // Ej: 'Monday'
        $letra_dia = $letras_dias[$dia_hoy] ?? null;          

        if (!$letra_dia) {             
            echo json_encode(["error" => "Día no reconocido"]);             
            exit;         
        }          

        $sql = "SELECT * FROM horari_grup WHERE dia_setmana = '$letra_dia' AND docent = '$document'";
        $resultado = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);          
        
        echo json_encode($resultado);  
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
        $fecha_sin = $_POST['fecha'] ?? null;

        $fecha_format = new DateTime($fecha_sin);     
        $fecha = $fecha_format->format('Y-m-d');    

        
        $sesionesSeleccionadas = $_POST['sesiones'] ?? [];  // Sesiones seleccionadas (valores de los checkboxes)
    
        foreach ($sesionesSeleccionadas as $index => $sesion) {
            $hora_inicio = $sesion[1];
            $hora_fin = $sesion[2];
            $dia = $sesion[0];
            $aula = $sesion[5];
            $grupo = $sesion[4];
            $asignatura = $sesion[3];
            $sesion_id = $sesion[6];

            // Log each session data for debugging
            error_log("Sesion data: hora_inicio=$hora_inicio, hora_fin=$hora_fin, dia=$dia, aula=$aula, grupo=$grupo, asignatura=$asignatura, sesion_id=$sesion_id");
            $document = $_POST['document'] ?? null;         
            $justificada = $_POST['justificada'] ?? null;         
            $jornada_completa = $_POST["jornada_completa"] ?? null;

            $sql = "INSERT INTO ausencias (hora_inicio, hora_fin, dia, aula, grupo, asignatura, sesion, document, justificada, jornada_completa, fecha) 
                VALUES ('$hora_inicio', '$hora_fin', '$dia', '$aula', '$grupo', '$asignatura', $sesion_id, '$document', $justificada, $jornada_completa, $fecha);";
                $resultadoIn = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);
    
    }
    
        if ($resultadoIn > 0) {
                            echo json_encode(["exito" => "Entrada registrada correctamente"]);
                        } else {
                            echo json_encode(["error" => "Error al registrar la entrada"]);
                        }
    }
        
        
        elseif ($accion === "") {
        // Add your logic here for the specific condition
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
