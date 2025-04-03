<?php
session_start();


if (!isset($_SESSION['document']) || !isset($_SESSION['nombre'])) {
    $nombre_profesor = "Desconocido";
    $document = "No encontrado";
}else{
    $nombre_profesor = $_SESSION['nombre'];
    $document = $_SESSION['document'];
  //Cojemos fecha y hora del momento del intento
  $fechaHora = date('Y-m-d H:i:s');
  //La linea que se insertara en el archivo
  $linea = "$fechaHora |  DNI: $document | Profesor: $nombre_profesor $apellido1 $apellido2 | Log Out(Salida)\n";
  //Abrimos el archivo
  $archivo = fopen("../servidor/registroAccesos.txt", "a");
  //Comprobamos que lo puede abrir
  if($archivo){
      //Escribimos la linea
      fwrite($archivo, $linea);
      //Cerramos el archivo por seguridad
      fclose($archivo);
  }else{
      // Si no se puede abrir, mostramos un error en consola
      error_log(" No se pudo abrir el archivo de registro de accesos.");
  }
}
session_destroy();    // Destruye la sesión por completo

header('Location: login.html'); // Redirige al login
exit();
?>