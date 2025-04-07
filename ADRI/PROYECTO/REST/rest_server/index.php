<?php 
include("config.php"); 
session_start(); 

$metodo = $_SERVER['REQUEST_METHOD']; 
$recurso = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);  

if ($metodo === 'GET') {
    $document = $_GET['document'] ?? null;      
    
    if (!$document) {         
        echo json_encode(["error" => "Parámetro 'document' requerido"]);     
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
