<?php include('config.php'); 
session_start(); 
$metodo = $_SERVER['REQUEST_METHOD']; 
$recurso = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);  

switch($metodo) {     
    case 'GET':         
        $document = $_GET['document'] ?? null;      
        
        if ($document) {         
            // Asociamos el día de la semana con su letra correspondiente         
            $letras_dias = [             
                'Monday' => 'L',             
                'Tuesday' => 'M',             
                'Wednesday' => 'X',             
                'Thursday' => 'J',             
                'Friday' => 'V',             
                'Saturday' => 'S',             
                'Sunday' => 'D'         
            ];          
            
            $dia_hoy = date('l'); // Ej: 'Monday'         
            $letra_dia = $letras_dias[$dia_hoy] ?? null;          
            
            if (!$letra_dia) {             
                echo json_encode(["error" => "Día no reconocido"]);             
                exit;         
            }          
            
            // Consulta: sesiones del profesor para el día actual         
            $sql = "SELECT * FROM horari_grup WHERE dia_setmana = '$letra_dia' AND docent = '$document'";         
            $resultado = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);          
            
            echo json_encode($resultado);     
        } else {         
            echo json_encode(["error" => "Parámetro 'document' requerido"]);     
        }     
        break;      
    
    // Nueva función para obtener el horario completo de un profesor por día
    case 'GET_HORARIO_PROFESOR':
        $document = $_GET['document'] ?? null;
        $dia = $_GET['dia'] ?? null;
        
        if ($document && $dia) {
            // Consulta para obtener el horario detallado del profesor
           $sql=" SELECT 
    // Concatenamos la hora de inicio y la hora de fin en un solo campo
    CONCAT(hora_inici, ' - ', hora_fi) AS Hora,
    
    // Seleccionamos la columna 'sesion' y le damos un alias
    sesion AS Sesion,
    
    // Seleccionamos la columna 'aula' y le damos un alias
    aula AS Aula,
    
    // Seleccionamos la columna 'grup' y le damos un alias
    grup AS Grupo,
    
    // Seleccionamos la columna 'nom_cas' y le damos un alias
    nom_cas AS Asignatura

FROM 
    // Especificamos la tabla 'guardias.horari_grup' y la alias 'hg'
    guardias.horari_grup hg
    
// Realizamos un JOIN con la tabla 'guardias.continguts' sobre la columna 'ensenyament'
JOIN 
    guardias.continguts c 
    ON hg.ensenyament = c.ensenyament

// Establecemos las condiciones para filtrar los resultados
WHERE 
    // Filtramos por el día de la semana
    hg.dia_setmana = :dia_setmana 
    
    // Filtramos por el docente utilizando el valor del parámetro ':document'
    AND hg.docent = :document

// Ordenamos los resultados por la hora de inicio de la clase
ORDER BY 
    hora_inici";

            
            $resultado_horario = conexion_bd(SERVIDOR, USER, PASSWD, BASE_DATOS, $sql);
            
            if (is_array($resultado_horario)) {
                echo json_encode($resultado_horario);
            } else {
                echo json_encode(["error" => "No se encontraron datos de horario"]);
            }
        } else {
            echo json_encode(["error" => "Se requieren los parámetros 'document' y 'dia'"]);
        }
        break;
    
    case 'PUT':         
        // Por implementar         
        break;      
    
    case 'DELETE':         
        // Por implementar         
        break;      
    
    case 'POST':         
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
                    $fechaHora = date('Y-m-d H:i:s');                     
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
                    $fechaHora = date('Y-m-d H:i:s');                     
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
        break;      
    
    default:         
        echo json_encode(["error" => "Opción incorrecta!!!!"]); 
}