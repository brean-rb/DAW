<?php
    /**Crea un script que liste los archivos de un directorio que
    esté por debajo de aquel en el que esté guardado el programa, como
    por ejemplo la subcarpeta “listar”. (Para probarlo habrá que crear el
    directorio y guardar en él algunos archivos de muestra). */

    $open_folder = opendir("listar");

    while($archivo = readdir($open_folder)){
        if(is_file("listar/".$archivo)){
            echo $archivo . "<br>";
        }
    }

?>