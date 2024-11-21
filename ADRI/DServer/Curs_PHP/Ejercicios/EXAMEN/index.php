<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Notas</title>
</head>
<body>
    <h2>Formulario de Notas</h2>
    <form action="notas.php" method="post">
        DNI: <input type="text" name="dni" id="dni"><br>
        Nombre: <input type="text" name="nombre" id="nombre"><br>
        Grupo: <input type="text" name="grupo" id="grupo"><br>
        Fecha y Hora: <input type="datetime-local" name="fechahora" id="fechahora"><br>
        Asignatura: <input type="text" name="assignatura" id="assignatura"><br>
        Nota: <input type="number" name="nota" id="nota"><br>
        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>
</html>
