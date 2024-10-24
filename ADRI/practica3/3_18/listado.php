<?php
$directorio = opendir("listar/");

while($archivo = readdir($directorio)){
    if (is_file("listar/".$archivo)) {
        echo $archivo . "<br>";
    }
}
?>