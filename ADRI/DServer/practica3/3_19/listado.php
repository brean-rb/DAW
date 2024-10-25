<?php
$directorio = opendir("listar/");

while($archivo = readdir($directorio)){
    if (is_file("listar/".$archivo)) {
    $info = new SplFileInfo($archivo);
    $ext= $info->getExtension();
    if ($ext == "txt") {
        echo $archivo . "<br>";
    }
    }
}
?>