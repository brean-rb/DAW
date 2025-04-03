<?php
session_start();
include('../config/config.php');

// Verificamos que el usuario ha iniciado sesión
if (!isset($_SESSION['document'])) {
    header('Location: login.html');
    exit();
}

$documento = $_SESSION['document'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {

    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {

        $tmpNombre = $_FILES['foto']['tmp_name'];
        $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nombreFinal = 'foto_' . $documento . '_' . time() . '.' . $extension;
        $rutaDestino = '../uploads/' . $nombreFinal;

        // ✅ Obtener foto actual desde la base de datos
        $sqlActual = "SELECT foto FROM usuarios WHERE document = '$documento'";
        $resActual = mysqli_query($conexion_db, $sqlActual);
        $anterior = mysqli_fetch_assoc($resActual)['foto'];

        // ✅ Eliminar la anterior si no es la default
        if ($anterior !== 'default.jpg' && file_exists("../uploads/" . $anterior)) {
            unlink("../uploads/" . $anterior);
        }

        // ✅ Subir la nueva
        if (move_uploaded_file($tmpNombre, $rutaDestino)) {
            $sql = "UPDATE usuarios SET foto = '$nombreFinal' WHERE document = '$documento'";
            mysqli_query($conexion_db, $sql);
            $_SESSION['foto'] = $nombreFinal;
        }
    }
}

header('Location: dashboard.php');
exit();
?>
