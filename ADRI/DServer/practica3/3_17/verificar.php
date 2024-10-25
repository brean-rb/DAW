<?php

include 'usuarios.php';
include 'ok.php';
//$usuario= $_POST["usuario"];
$usuario="";
if(isset($_POST["usuario"])){
 $usuario = filter_input(INPUT_POST, "usuario", FILTER_SANITIZE_STRING);   
}
$contra = $_REQUEST["contrasena"];

$existe = comprobar($usuario,$contra);

$open_file = fopen("accesos.txt", "a");

if ($open_file) {
    if ($existe) {
    mensaje();
    $escrito = fwrite($open_file, "El usuario " . $usuario . " ha accedido al sistema");
    
}else{
    $escrito = fwrite($open_file, "Intento fallido de acceso del usuario: " . $usuario);
    header("location: error.html");
}
}else {
    echo "Error al escribir en el archivo";
}

$close_file = fclose($open_file);

if($close_file){
    echo "Se cerró bien el archivo";
}else {
    echo "No se cerró de forma adecuada";
}