<!DOCTYPE html>
<!--
 Toma el nombre de un fichero sobre el que realizar operaciones
 como recorrerlo, añadir, modificar y borrar contenido.
 Modificar puede ser con acceso secuencial o directo
-->
<html>
  <head>
   <meta charset="UTF-8">
   <title>Fichero</title>
  </head>
  <body>
     <form name="ficheros" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" >
       <div style="border-style:solid;height:30px;width:450px;padding:7px;">
         <label for= "nombrefichero">Nombre del Fichero</label>
         <input type="text" id="nombrefichero" name="nombrefichero">
       </div>
       <div style="border-style:solid;height:30px;width:850px;padding:7px;">  
         <label for= "elembuscar">Buscar/Borrar</label>
         <input type="text" id="elembuscar" name="elembuscar">
         <label for= "elemreemplazar">Reemplazar </label>
         <input type="text" id="elemreemplazar" name="elemreemplazar">
         <label for= "elemnuevo">Nuevo </label>
         <input type="text" id="elemnuevo" name="elemnuevo">         
       </div>
       <div style="padding:10px;">
       <input type="submit" name="leer" value="Leer">
       <input type="submit" name="eliminar" value="Eliminar" style="background-color: #FF0000;">
       <input type="submit" name="reemplazar" value="Reemplazar" style="background-color: #0066FF;">
       <input type="submit" name="reemplazardirect" value="ReemplazaDirec" style="background-color: #04AA6D;">
       <input type="submit" name="buscar" value="Buscar">
       <input type="submit" name="nuevo" value="Nuevo">
       </div>
     </form>
  </body>
</html>

<?php

include ("fichero.php");
define("RUTA","ficheros/");
$res =false;
if(!empty($_POST["nombrefichero"])) {
  
  $fichero = new fichero(RUTA . htmlspecialchars(trim($_POST["nombrefichero"])));
  
  if(isset($_POST["leer"])){
      $res = $fichero->leer();
      print_r($res);
      echo "<br>";
  }
  if(isset($_POST["nuevo"]) && !empty($_POST["elemnuevo"])){
    $res = $fichero->nuevo(htmlspecialchars(trim($_POST["elemnuevo"])));    
  }
  if(isset($_POST["buscar"]) && !empty($_POST["elembuscar"])){
    $res = $fichero->buscar(htmlspecialchars(trim($_POST["elembuscar"])));
    if($res === true) {
       echo htmlspecialchars(trim($_POST["elembuscar"])) . "  encontrado<br>"; 
    } 
    else {
      echo htmlspecialchars(trim($_POST["elembuscar"])) . " NO encontrado<br>";
    }   
  }
  if(isset($_POST["eliminar"]) && !empty($_POST["elembuscar"])){
    $res = $fichero->eliminar(htmlspecialchars(trim($_POST["elembuscar"])));
    if($res === true) {
       echo htmlspecialchars(trim($_POST["elembuscar"])) . "  borrado del fichero <br>"; 
    } 
    else {
      echo htmlspecialchars(trim($_POST["elembuscar"])) . " NO eliminado<br>";
    }   
  }
  if(isset($_POST["reemplazar"]) && !empty($_POST["elembuscar"]) && !empty($_POST["elemreemplazar"])){
    $res = $fichero->modificar(htmlspecialchars(trim($_POST["elembuscar"])),htmlspecialchars(trim($_POST["elemreemplazar"])));
    if($res === true) {
       echo htmlspecialchars(trim($_POST["elembuscar"])) . "  cambiado a " . htmlspecialchars(trim($_POST["elemreemplazar"]))  ."<br>"; 
    } 
    else {
      echo htmlspecialchars(trim($_POST["elembuscar"])) . " NO modificado<br>";
    }   
  }
  if(isset($_POST["reemplazardirect"]) && !empty($_POST["elembuscar"]) && !empty($_POST["elemreemplazar"])){
    $res = $fichero->modificarDirect(htmlspecialchars(trim($_POST["elembuscar"])),htmlspecialchars(trim($_POST["elemreemplazar"])));
    if($res === true) {
       echo htmlspecialchars(trim($_POST["elembuscar"])) . "  cambiado directamente a " . htmlspecialchars(trim($_POST["elemreemplazar"]))  ."<br>"; 
    } 
    else {
      echo htmlspecialchars(trim($_POST["elembuscar"])) . " NO modificado directamente<br>";
    }   
  }
}

?>
