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
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">+18</option>
          </select>
          <label for="codigomonitor">Código empleado/monitor</label>
          <input type="text" id="codigomonitor" name="codigomonitor">
          <select name="sociomonitor" id="sociomonitor">
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