<?php
    function read_file($file, $action){
        $open_file = fopen($file, $action);
        $size_file = filesize($file);

        if ($open_file) {
            $read_file = fread($open_file, $size_file);
            echo $read_file . "<br>";
        } else {
            echo "error al abrir el archivo";
        }


        $close_file = fclose($open_file);   
    }
?>