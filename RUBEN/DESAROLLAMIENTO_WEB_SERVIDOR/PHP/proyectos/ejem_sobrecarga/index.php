<!-- <!DOCTYPE html>
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
       <div style="border-style:solid;height:30px;width:370px;padding:7px;">
         <label for= "codigomonitor">Código empleado</label>
         <input type="text" id="codigomonitor" name="codigomonitor">
       </div>
       <div style="border-style:solid;height:30px;width:370px;padding:7px;">
          <label for="edad">introduzca la edad</label>
          <select name="edad">
            <option value="14">10-14</option>
            <option value="18">15-18</option>
            <option value="19">mayor de 18</option>
          </select>
       </div>
       <br>
       <input type="submit" name="pagar" value="Pagar">
       <input type="submit" name="delete" value="Eliminar">
       <input type="submit" name="add" value="Añadir">
       <input type="submit" name="see" value="Ver">    
     </form>
  </body>
</html>

<?php
  include ("tiquet.php");
  include ("monitores.php");
  include ("socios.php");

  $cant = 0;
  $pagar = new tiquet();

  if ($pagar->getExcepcionFicheros() !== false) {
      echo $pagar->getExcepcionFicheros() . "<br>";
  } else {
    if (isset($_POST["pagar"])) {
      if (!empty($_POST["nombresocio"]) && !empty($_POST["fechacuota"])) {
        $cant = $pagar->pago(trim($_POST["nombresocio"]), $_POST["fechacuota"]);
      } else {
        if (!empty($_POST["codigomonitor"])) {
          $cant = $pagar->pago(trim($_POST["codigomonitor"]));
        } else {
          if ($cant === 0) {
            $cant = $pagar->pago();
          }
        }
      }

      if ($cant !== false) {
        echo "El pago realizado es de: " . $cant . "<br>";
      } else {
        echo "Error en el pago<br>";
      }
      
    } else if (isset($_POST["delete"])) {
        if (!empty($_POST["codigomonitor"])) {
          $option = new monitores($_POST["codigomonitor"]);

          $result = $option->select_option(1);

          if($result){
              echo "empleado eliminado";

          } else {
              echo "el empleado no a sido eliminado";

          }
        } else if (!empty($_POST["nombresocio"])){
            
          $option = new socios($_POST["nombresocio"]);

          $result = $option->select_option(1);

          if($result){
              echo "socio eliminado";

          } else{
            echo "el socio no a sido eliminado";
          }

        } else {
          echo "Por favor, ingrese el nombre del socio o código del empleado.";
        }

    } else if (isset($_POST["add"])) {
        if (!empty($_POST["codigomonitor"])) {
          $option = new monitores($_POST["codigomonitor"]);

          $result = $option->select_option(2);

          if($result){
            echo "empleado añadido";
          } else {
            echo "el empleado no a sido añadido";
          }
        } else if (!empty($_POST["nombresocio"]) && !empty($_POST["fechacuota"])){
            
          $option = new socios($_POST["nombresocio"], $_POST["fechacuota"]);

          $result = $option->select_option(2);

          if($result){
              echo "socio añadido";

          } else{
            echo "el socio no a sido añadido";
          }

        } else{
          echo "ERROR: no ha añadido ningun campo";
        }

    } else if (isset($_POST["see"])) {
        if (!empty($_POST["codigomonitor"])) {
          $option = new monitores($_POST["codigomonitor"]);

          $result = $option->select_option(3);

          if($result){
            echo "el empleado existe";

          } else {
            echo "el empleado no existe";
          }
        } else if(!empty($_POST["nombresocio"])){
          $option = new socios($_POST["nombresocio"]);

          $result = $option->select_option(3);

          if($result){
            echo "el socio existe";

          } else{
            echo "el socio no existe";
          }

        } else{
          echo "Por favor, ingrese el nombre del socio o código del empleado.";
        }
      }

    }

 // ExcepcionFicheros
?>

