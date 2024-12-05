<!DOCTYPE html>
<!--
Ejemplo Cliente REST para el Servicio Web frutería
Alta nueva fruta
-->
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <title>Alta nueva fruta </title>
    </head>
<body>
<div id="main" style="position:absolute; left: 10%">   
<h3>Alta en frutería</h3>
<form name="crear" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <div class="input-group temporada">
        <div class="input-group-prepend">
         <span class="input-group-text" id="inputGroup-sizing-default">Temporada</span>
        </div>
        <input type="text" class="form-control" aria-label="Temporada" aria-describedby="inputGroup-sizing-default" name="temporada" value="Invierno" >
    </div>
    <div class="input-group fruta">
        <div class="input-group-prepend">
         <span class="input-group-text" id="inputGroup-sizing-default">Fruta</span>
        </div>
        <input type="text" class="form-control" aria-label="Fruta" aria-describedby="inputGroup-sizing-default" name="fruta" >
    </div>
    <div class="input-group precio">
        <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Precio Kg</span>
        </div>
        <input type="text" class="form-control" aria-label="precio" aria-describedby="inputGroup-sizing-default" name="precio" >
    </div>
    <input type="submit" name="crear" value="Nueva Fruta" class="btn btn-primary">
    <input type="reset" name="cancelar" value="Cancelar" class="btn btn-danger">
</form> 
<?php

/* 
 * Aplicación Servicio Web REST fruteria
 * Alta de nueva fruta método POST
 *  
 */
include 'curl_conexion.php';
include 'config.php';

$res = '<div class="card" style="width: 18rem;">';
$res .= '<div class="card-body">';
$res .= '<p class="card-text">';

if(isset($_REQUEST["crear"])){
    if(isset($_REQUEST["temporada"]) && isset($_REQUEST["fruta"]) && isset($_REQUEST["precio"])){
        $temporada= filter_input(INPUT_POST, "temporada", FILTER_SANITIZE_STRING);
        $temporada = strtoupper($temporada);
        $fruta = filter_input(INPUT_POST, "fruta", FILTER_SANITIZE_STRING);
        $fruta = strtoupper($fruta);
        $precio_kg = filter_input(INPUT_POST, "precio", FILTER_SANITIZE_STRING);
        $res .= '<h5 class="card-title">Datos de ' . $fruta . '</h5>';
        $params = array('temporada' => $temporada, 'fruta' => $fruta, 'precio_kg' => $precio_kg) ;
        $url = URL . "index.php";
        $response = curl_conexion($url, 'POST', $params);
        $res .= json_decode($response);
        $res .=  $fruta . 'añadida a la BD</p>';
        $res .= '<a href="index.php" class="btn btn-primary">Cerrar</a>';
        $res .= '</div>';
        $res .= '</div>';
        echo $res;
    }
}
?>
<!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</div>    
</body>
</html>