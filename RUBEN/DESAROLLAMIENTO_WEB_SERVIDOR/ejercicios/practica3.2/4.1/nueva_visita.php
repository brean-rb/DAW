<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>añadir comentario</title>
</head>
<body>
    <h1>añade un comentario</h1>

    <form action="insertar_visita.php" method="post">
        <p>usuario: </p>
        <input type="text" name="user"><br>
        <p>comentario: </p>
        <input type="text" name="coment"> <br>
        <input type="submit" value="enviar">
    </form>
</body>
</html>