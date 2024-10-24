<?php
    /** Mejorar el programa anterior para que liste solo los 
     * contenidos del directorio que sean de un solo tipo (por ejemplo con la
    *  extensión .php).
    */

    $open_folder = opendir("listar");

    while($archivo = readdir($open_folder)){

        if(is_file("listar/".$archivo)){
            $info = new SplFileInfo($archivo);
            $extension = $info->getExtension();

            if($extension == "txt"){

                echo $archivo . "<br>";
            }

        }
    }

?>