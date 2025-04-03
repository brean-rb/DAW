<?php
session_start(); // Me guardará los datos del usuario cuando inicie sesion
include('../config/config.php');
//Comprobamos que es una peticion POST
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    // Antes de comparar limpiar las cadenas 
    $document = filter_input(INPUT_POST, 'document', FILTER_SANITIZE_SPECIAL_CHARS);
    $rawPassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

     //Para poder permitir tanto 01-01-2001, como 01/01/2001 como 01012001
    $soloNumeros = preg_replace('/[^0-9]/', '', $rawPassword);
    if (strlen($soloNumeros) === 8) {
        // Posibles formatos: ddmmyyyy o yyyymmdd
        if (intval(substr($soloNumeros, 0, 4)) > 1900) {
            // Si empieza por año → formato americano: yyyymmdd → dd/mm/yyyy
            $anio = substr($soloNumeros, 0, 4);
            $mes = substr($soloNumeros, 4, 2);
            $dia = substr($soloNumeros, 6, 2);
        } else {
            // Formato europeo: ddmmyyyy → dd/mm/yyyy
            $dia = substr($soloNumeros, 0, 2);
            $mes = substr($soloNumeros, 2, 2);
            $anio = substr($soloNumeros, 4, 4);
        }
    
        // Montamos la contraseña normalizada
        $password = "$dia/$mes/$anio";
    } else {
        // Si no se puede interpretar, lo dejamos como está
        $password = $rawPassword;
    }
//Hacemos la consulta
    $sql = "SELECT * FROM usuarios WHERE document = '$document'";
    $resultado = mysqli_query($conexion_db, $sql);

    //Variables que serviran para decir el nombre del profesor que se loggeo y si pudo entrar o se equivoco
    $login_correcto = false;
    $nombre_profesor = "Desconocido";
    $apellido1 = "";
    $apellido2 = "";

    //Comprobamos que la consulta se reliza bien y que al menos existe un usuario que coincide ya que si es asi significa que esta creado el usuario
    if ($resultado && mysqli_num_rows($resultado) === 1) {
        //Creamos un array que almacenara todos los campos del usuario que coincide(document,password,rol)
        $usuario = mysqli_fetch_assoc($resultado);
        //Como esta cifrada la contrasena usamos el metodo password_verify para comparar
        $passCifrado = $usuario['password'];
    
        if (password_verify($password, $passCifrado)) {
            //Decimos true a la variable de loggeo correcto
            $login_correcto = true;

            // Buscamos el nombre en la tabla docentes
            $sqlNombre = "SELECT * FROM docent WHERE document = '$document'";
            $resNombre = mysqli_query($conexion_db, $sqlNombre);
            //Comprobamos si se ejecuta bien y encuentra coincidencia
            if ($resNombre && mysqli_num_rows($resNombre) === 1) {
                //Creamos un array que almacenara todos los campos del profe
                $fila = mysqli_fetch_assoc($resNombre);
                //Cojemos el nombre y apellido para insertarlo en el archivo
                $nombre_profesor = $fila['nom'];
                $apellido1 = $fila['cognom1'];
                $apellido2 = $fila['cognom2'];

            }
            $sqlFoto = "SELECT foto FROM usuarios WHERE document = '$document'";
            $resFoto = mysqli_query($conexion_db, $sqlFoto);
            if ($resFoto && mysqli_num_rows($resFoto) === 1) {
                $fotos = mysqli_fetch_assoc($resFoto);
                $foto = $fotos['foto'];
                $_SESSION['foto'] = $foto;
            }
             // Guardar en sesión
             $_SESSION['document'] = $document;
             $_SESSION['nombre'] = $nombre_profesor;
             $_SESSION['apellido1'] = $apellido1;
             $_SESSION['apellido2'] = $apellido2;
             $_SESSION['rol'] = $usuario['rol']; 
            // Si coincide redirigimos a la vista principal del usuario con header
            header('location: dashboard.php');

        } else{
            // Si no coincide volvemos a la vista del login pasandole por metodo GET el error diciendo que no encontramos el usuario
            header('location: ../../cliente/login.html?error=usuario_inexistente');
        }
    }

    //Cojemos fecha y hora del momento del intento
    $fechaHora = date('Y-m-d H:i:s');
    //Comprobamos si lo consiguio con el bool de antes(condicional ternario)
    $estado = $login_correcto ? " Éxito" : " Fallo";
    //La linea que se insertara en el archivo
    $linea = "$fechaHora | $estado | DNI: $document | Profesor: $nombre_profesor $apellido1 $apellido2 | Log In(Entrada)\n";
    //Abrimos el archivo
    $archivo = fopen("../registroAccesos.txt", "a");
    //Comprobamos que lo puede abrir
    if($archivo){
        //Escribimos la linea
        fwrite($archivo, $linea);
        //Cerramos el archivo por seguridad
        fclose($archivo);
    }else{
        // Si no se puede abrir, mostramos un error en consola
        error_log(" No se pudo abrir el archivo de registro de accesos.");
    }
    //Finalizamos la conexion con la base de datos
    mysqli_close($conexion_db);
}
?>