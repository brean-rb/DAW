<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
</head>
<body>
    <h1>Archivos subidos:</h1>
    <ul>
        <?php
        $directorio = opendir("descargas/");
        $lista = array();
        $i =0;
        while($archivo = readdir($directorio)){
            if (is_file("descargas/".$archivo)) {
                $lista[$i] = $archivo;
                $i++;
            }
        }
        $orden = sort($lista);
        for ($i=0; $i < count($lista); $i++) { 
            echo $lista[$i] . " ".filesize("descargas/" . $lista[$i]). " B <br>";
        }

        closedir($folder);
        ?>
    </ul>
    <a href="subir.php">Subir archivo</a>
<a href="listar.php">Listar archivos</a>
</body>
</html>