<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listar comentarios</title>
</head>
<body>
    <h1>comentarios del libro</h1>
    <a href="nueva_visita.php">añadir comentario</a><br>
    <?php
        require("../bibliotecas/print_file.php");

        read_file("/opt/lampp/htdocs/practica3.2/4.2/visitas.txt", "r");
    ?>

    
</body>
</html>