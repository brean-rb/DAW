<?php

include 'curl_conex.php';
define("URL","/opt/lampp/htdocs/DAW/ADRI/DServer/Curs_PHP/Ejercicios/EXempleados/serv/");

if (isset($_REQUEST["mostrarEmpleado"])) {
    echo "HOLA";
    $nif = filter_input(INPUT_POST,"nif",FILTER_SANITIZE_STRING);
    $url = URL . "servidor.php?nif=".$nif;
    $resp = curl_con($url,"GET");
    $empl = json_decode($resp,TRUE);
    $datos = "<br>Nombre: " . $empl["nombre"] . "<br>Telefono: " . $empl["telf"] . "<br>Nif: " . $empl["nif"] . "<br>Sueldo: " . $empl["sueldo"];
    $ver = "<p>".$datos."</p>";
}