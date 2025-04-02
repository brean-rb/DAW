<?php

//Archivo que se encargara de almacenar los datos con la conexion a la base de datos(guardias.sql)
DEFINE ("SERVIDOR", "localhost");
DEFINE ("USER", "root");
DEFINE ("PASSWD", "");
DEFINE ("BASE_DATOS", "guardias");

$conexion_db = @mysqli_connect(SERVIDOR,USER,PASSWD,BASE_DATOS);

if (!$conexion_db) {
    //Si no conecta a la base de datos terminamos la aplicacion
    die("Error de conexión: " . mysqli_connect_error());
}
?>