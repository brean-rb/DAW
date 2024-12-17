<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listar comentarios</title>
</head>
<body>
    <h1>comentarios del libro</h1>
    <a href="nueva_visita.php">añadir comentario</a>
    <?php
        $open_file = fopen("visitas.txt", "r");
        $size_file = filesize("visitas.txt");

        if ($open_file) {
            $read_file = fread($open_file, $size_file);
            echo $read_file . "<br>";
        } else {
            echo "error al abrir el archivo";
        }


        $close_file = fclose($open_file);
    ?>

    
</body>
</html>