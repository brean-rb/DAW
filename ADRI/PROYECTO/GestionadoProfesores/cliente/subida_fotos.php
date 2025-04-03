<?php
session_start();

// Verificamos que el usuario ha iniciado sesión
if (!isset($_SESSION['document'])) {
    header('Location: login.html');
    exit();
}

// Obtenemos el documento del usuario desde la sesión
$documento = $_SESSION['document'];

// Comprobamos que se ha enviado el formulario y hay archivo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {

    // Verificamos que no haya errores en la subida del archivo
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {

        // Ruta temporal y extensión del archivo subido
        $tmpNombre = $_FILES['foto']['tmp_name'];
        $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

        // Generamos un nombre único para la nueva imagen
        $nombreFinal = 'foto_' . $documento . '_' . time() . '.' . $extension;

        // Ruta de destino donde se guardará la imagen
        $rutaDestino = 'uploads/' . $nombreFinal;

        // Movemos el archivo a la carpeta definitiva
        if (move_uploaded_file($tmpNombre, $rutaDestino)) {

            // Conectamos a la base de datos
            $conexion = mysqli_connect("localhost", "root", "", "tu_base");

            // Comprobamos conexión
            if (!$conexion) {
                die("Error al conectar a la base de datos: " . mysqli_connect_error());
            }

            // Actualizamos el campo 'foto' en la tabla usuarios usando el documento como identificador
            $sql = "UPDATE usuarios SET foto = '$nombreFinal' WHERE document = '$documento'";
            mysqli_query($conexion, $sql);

            // Actualizamos también la variable de sesión con el nuevo nombre del archivo
            $_SESSION['foto'] = $nombreFinal;

            // Cerramos la conexión con la base de datos
            mysqli_close($conexion);
        }
    }
}

// Redirigimos de nuevo al dashboard
header('Location: dashboard.php');
exit();
?>
