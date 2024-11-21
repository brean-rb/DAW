<?php
// Incluir configuración si es necesario
include("config.php");
include("index.php");

// Verificar si el formulario ha sido enviado
if (isset($_POST["enviar"])) {
    // Acceder a los datos del formulario
    $dni = $_POST["dni"];
    $nombre = $_POST["nombre"];
    $grupo = $_POST["grupo"];
    $fechahora = $_POST["fechahora"];
    $assignatura = $_POST["assignatura"];
    $nota = $_POST["nota"];

    // Aquí puedes hacer lo que necesites con los datos
    // Por ejemplo, solo mostrar "hola" o los datos del formulario
    echo "Hola, los datos recibidos son:<br>";
    echo "DNI: $dni<br>";
    echo "Nombre: $nombre<br>";
    echo "Grupo: $grupo<br>";
    echo "Fecha y Hora: $fechahora<br>";
    echo "Asignatura: $assignatura<br>";
    echo "Nota: $nota<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas Recibidas</title>
</head>
<body>
    <h2>Formulario Procesado</h2>
    <p>Gracias por enviar tus datos. Aquí están los valores recibidos:</p>
    <!-- Aquí podría ir una confirmación, redirección o algo más -->
</body>
</html>
