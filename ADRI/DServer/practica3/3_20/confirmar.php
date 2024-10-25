<?php
$directorio = 'descargas/'; 
$temporal = $_FILES["archivo"]["tmp_name"];
$destino = $directorio . $_FILES["archivo"]["name"];


$dir = opendir("descargas/");    


if (move_uploaded_file($temporal, $destino)) {
    echo "Archivo subido con éxito: " . $_FILES["archivo"]["name"] .  "(" . filesize($_FILES["archivo"]["name"]) . " B)". "<br>" ;
    
    
}else {
    echo "Ocurrió un error, no se ha podido subir el archivo.";
}
?>

<a href="subir.php">Subir otro archivo</a>
<a href="listar.php">Listar archivos</a>
