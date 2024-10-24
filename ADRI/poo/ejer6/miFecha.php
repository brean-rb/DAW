<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method ="post">
        Introduce una fecha: <input type="date" name="fecha" id="">
        <br><input type="submit" value="Enviar">
    </form>
    <?php
    include('validarfecha.php');
    $cambiar = strtotime($_POST["fecha"]);
    if (isset($_POST["fecha"]) && !empty($_POST["fecha"])) {
        $fechaFormat=date("d/m/Y", $cambiar);
         $dia = substr($fechaFormat,0,2);
         $barra=strpos($fechaFormat,"/");
         $mes = substr($fechaFormat,$barra + 1,2);
         $ano = substr($fechaFormat,6,10);
         $fecha = new validarfecha($dia,$mes,$ano);
         $result = $fecha->comprobacion();
         echo $result;
    }else{
        echo "Fecha erronea";
    }
    ?>
</body>
</html>