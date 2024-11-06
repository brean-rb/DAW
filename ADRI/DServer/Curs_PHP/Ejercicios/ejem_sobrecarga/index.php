    <!-- <!DOCTYPE html>
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
    <style>
      body {
        font-family: sans-serif;
      }
    </style>

    <body>
      <form name="pagos" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <div style="border-style:solid;height:30px;width:650px;padding:7px;">
          <label for="nombresocio">Nombre del Socio</label>
          <input type="text" id="nombresocio" name="nombresocio">
          <label for="fechacuota">Fecha pago cuota</label>
          <input type="date" id="fechacuota" name="fechacuota">
        </div>
        <div style="border-style:solid;height:30px;width:650px;padding:7px;">
          <label for="camedad">Introduzca la edad</label>
          <select name="edad">
            <option value="19" name="edad">+18</option>
            <option value="18" name="edad">18</option>
            <option value="18" name="edad">17</option>
            <option value="18" name="edad">16</option>
            <option value="18" name="edad">15</option>
            <option value="14" name="edad">14</option>
            <option value="14" name="edad">13</option>
            <option value="14" name="edad">12</option>
            <option value="14" name="edad">11</option>
            <option value="14" name="edad">10</option>


          </select>
          <label for="codigomonitor">Código empleado/monitor</label>
          <input type="text" id="codigomonitor" name="codigomonitor">
          <select name="sociomonitor" id="sociomonitor">
          <option name="sociomonitor" value="Normal">Normal</option>
            <option name="sociomonitor" value="Monitor">Monitor</option>
            <option name="sociomonitor" value="Socio">Socio</option>
          </select>
        </div>
        <input type="submit" name="pagar" value="Pagar">
        <input type="submit" name="ver" value="Ver Monitor/Socio">
        <input type="submit" name="anadir" value="Añadir Monitor/Socio">
        <input type="submit" name="eliminar" value="Eliminar Monitor/Socio">


      </form>
    </body>

    </html>

    <?php
    include("personas.php");


    ?>