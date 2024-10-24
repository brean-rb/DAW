<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de archivos</title>
</head>
<body>
    <h1>Archivos disponibles</h1>
    <ul>
        <?php
            $folder = opendir("descargas");
            $lista = [];
            $i = 0;

            while($file = readdir($folder)){
                $filepath = "descargas/" . $file;
                if(is_file($filepath)){
                    $lista[$i] = $file;
                    $i++;
                }
            }

            sort($lista);

            foreach($lista as $archivo){
                echo $archivo . " tamaño: " . filesize("descargas/" . $archivo) . " B<br>"; 
            }

            closedir($folder);
        ?>
    </ul>
    <a href="subir.php">Subir un archivo</a>
</body>
</html>
