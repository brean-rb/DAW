<?php

include '/servidor/config/config.php';
//Comprobamos que es una peticion POST
if($_SERVER['REQUEST_METHOD']=== 'POST'){
    // Antes de comparar limpiar las cadenas 
    $document = filter_input(INPUT_POST, 'document', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    //Hacemos la consulta
    $sql = "SELECT * FROM usuarios WHERE document = '$document'";
    $resultado = mysqli_query($conexion_db, $sql);

    //Comprobaamos que la consulta se reliza bien y que al menos existe un usuario que coincide ya que si es asi significa que esta creado el usuario
    if ($resultado && mysqli_num_rows($resultado) === 1) {
        //Creamos un array que almacenara todos los campos del usuario que coincide(document,password,rol)
        $usuario = mysqli_fetch_assoc($resultado);
        //Como esta cifrada la contrasena usamos el metodo password_verify para comparar
        $passCifrado = $usuario['password'];
    
        if (password_verify($password, $passCifrado)) {
            // Si coincide redirigimos a la vista principal del usuario con header
            header('location: \cliente\paginas\dashboard.html');
        } else{
            // Si no coincide volvemos a la vista del login pasandole por metodo GET el error diciendo que no encontramos el usuario
            header('location: \cliente\paginas\login.html?error=usuario_inexistente');
        }
    }

    //Finalizamos la conexion con la base de datos
    mysqli_close($conexion_db);
}
?>