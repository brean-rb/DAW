<?php 
    $file = $_FILES["archivo"];
    $temp_file = $file["tmp_name"];
    $folder = "descargas/" . $file["name"];

    if(move_uploaded_file($temp_file, $folder)){
        echo "archivo subido con exito" . "<br>";
        echo "el nombre del archivo subido es: " . $_FILES["archivo"]["name"] . "<br>";
        echo "el tamaño del archivo subido es: " . filesize($folder) . "bytes" . "<br>";
    } else {
        echo "ocurrió un error, no se ha podido subir el archivo";
    }
?>
    
<a href="subir.php">Subir otro archivo</a>
<a href="listar.php">Listar archivos</a>
