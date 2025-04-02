<?php

include('../servidor/config/config.php');
//Comprobamos que es una peticion POST
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    // Antes de comparar limpiar las cadenas 
    $document = filter_input(INPUT_POST, 'document', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    //Hacemos la consulta
    $sql = "SELECT * FROM usuarios WHERE document = '$document'";
    $resultado = mysqli_query($conexion_db, $sql);

    //Variables que serviran para decir el nombre del profesor que se loggeo y si pudo entrar o se equivoco
    $login_correcto = false;
    $nombre_profesor = "Desconocido";

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
                //Cojemos el nombre para insertarlo en el archivo
                $nombre_profesor = $fila['nom'];
            }

            // Si coincide redirigimos a la vista principal del usuario con header
            header('location: dashboard.html');

        } else{
            // Si no coincide volvemos a la vista del login pasandole por metodo GET el error diciendo que no encontramos el usuario
            header('location: login.html?error=usuario_inexistente');
        }
    }

    //Cojemos fecha y hora del momento del intento
    $fechaHora = date('Y-m-d H:i:s');
    //Comprobamos si lo consiguio con el bool de antes(condicional ternario)
    $estado = $login_correcto ? " Éxito" : " Fallo";
    //La linea que se insertara en el archivo
    $linea = "$fechaHora | $estado | DNI: $document | Profesor: $nombre_profesor\n";
    //Abrimos el archivo
    $archivo = fopen("../servidor/registroAccesos.txt", "a");
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