<?php

define("SERVER" ,"localhost");
define("USER", "root");
define("PASSW", "root");
define("DATABASE", "notas_examenes");

$conex = @mysqli_connect(SERVER, USER, PASSW, DATABASE);
try{
if ($conex) {
    echo "conectado correctamente";
}else{
    throw new miError("Error al abrir la base de datos");
}
}catch(miError $e){
    echo $e->getMessage();
}