<!DOCTYPE html>
<!--
  Toma los datos para pagar en instalaciones deportivas
  Normal sin ningún dato
  Socio Nombre y fecha de pago de la cuota
  Empleado código de empleado
-->
<html>
  <head>
   <meta charset="UTF-8">
   <title>Pagar Sports</title>
  </head>
  <body>
     <form name="pagos" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" >
       <div style="border-style:solid;height:30px;width:650px;padding:7px;">
         <label for= "nombresocio">Nombre del Socio</label>
         <input type="text" id="nombresocio" name="nombresocio">
         <label for= "fechacuota">Fecha pago cuota</label>
         <input type="date" id="fechacuota" name="fechacuota">
       </div>
       <div style="border-style:solid;height:30px;width:650px;padding:7px;">
        <label for="camedad">Introduzca la edad</label>
        <select name="edad"><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option></select>
         <label for= "codigomonitor">Código empleado/monitor</label>
         <input type="text" id="codigomonitor" name="codigomonitor">
       </div>
       <input type="submit" name="pagar" value="Pagar">
       <input type="submit" name="ver" value="Ver Monitor/Socio">
       <input type="submit" name="anadir" value="Añadir Monitor/Socio">
       <input type="submit" name="eliminar" value="Eliminar Monitor/Socio">


     </form>
  </body>
</html>

<?php
include ("tiquet.php");
include ("monitores.php");
$cant = 0;
$pagar = new tiquet();

if ($pagar->getExcepcionFicheros() !== false) {
    echo $pagar->getExcepcionFicheros() . "<br>";
}
else{
 if(isset($_POST["pagar"])){
  if(!empty($_POST["nombresocio"]) && !empty($_POST["fechacuota"])) {
     $cant = $pagar->pago(trim($_POST["nombresocio"]), $_POST["fechacuota"]);
  }
  else {
    if(!empty($_POST["codigomonitor"])) {
      $cant = $pagar->pago(trim($_POST["codigomonitor"]));
    }
    else {
       if($cant === 0) {
          $cant = $pagar->pago();
      }
    }
  }    
  if($cant !== false) {
    echo "El pago realizado es de: " . $cant . "<br>";
  }
  else {
    echo "Error en el pago<br>";
  }
 } // pagar
} // ExcepcionFicheros

if(isset($_POST["ver"])){

if (isset($_POST["codigomonitor"]) && !empty($_POST["codigomonitor"])) {
  $monitor1 = new monitores($_POST["codigomonitor"]);
  $monitor1->verMonitor();
}else{
  echo "Defina un codigo de monitor";
}
}
?>
