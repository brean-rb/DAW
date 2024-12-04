<!DOCTYPE html>
<!--
Ejemplo Cliente REST para el Servicio Web frutería
-->
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <title>Cliente Fruteria REST </title>
    </head>
<body>
<div id="main" style="position:absolute; left: 10%">   
<h3>Frutería</h3>
<!-- Carrusel de frutas -->
<div id="carousel" class="carousel slide" data-ride="carousel" >
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img  src="images/cerezas.jpg" alt="Cerezas"  height="250" width="250">
    </div>
    <div class="carousel-item">
      <img  src="images/fresas.jpg" alt="Fresas"   height="250" width="250">
    </div>
    <div class="carousel-item">
      <img  src="images/melocotones.jpg" alt="Melocotones"  height="250" width="250">
    </div>
    <div class="carousel-item">
      <img  src="images/peras.jpg" alt="Peras"  height="250" width="250">
    </div> 
    <div class="carousel-item">
      <img  src="images/manzanas.jpeg" alt="Manzanas"  height="250" width="250">
    </div>  
    <div class="carousel-item">
        <img  src="images/naranjas.jpeg" alt="Naranjas"  height="250" width="250">
    </div>  
  </div>
</div>
<form name="fruteria" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
    <div style="border-style: solid; border-color: green; border-radius: 8px;">
    <div class="input-group temporada" style="border-style: solid; border-color: green; border-radius: 4px;">
        <div class="input-group-prepend">
         <span class="input-group-text" id="inputGroup-sizing-default">Temporada</span>
        </div>
        <input type="text" class="form-control" aria-label="Temporada" aria-describedby="inputGroup-sizing-default" name="temporada" value="Invierno" >
        <input type="submit" name="validar" value="Temporada" class="btn btn-success">
    </div>
    <div class="input-group fruta">
        <div class="input-group-prepend">
         <span class="input-group-text" id="inputGroup-sizing-default">Fruta</span>
        </div>
        <input type="text" class="form-control" aria-label="Fruta" aria-describedby="inputGroup-sizing-default" name="fruta" >
    </div>
        <input type="submit" name="validar2" value="Fruta" class="btn btn-success">
    </div>
    <div style="border-style: solid; border-color: yellow; border-radius: 8px;">
    <div class="input-group id" style="border-style: solid; border-color: yellow; border-radius: 4px;">
        <div class="input-group-prepend">
         <span class="input-group-text" id="inputGroup-sizing-default">ID</span>
        </div>
        <input type="text" class="form-control" aria-label="Fruta" aria-describedby="inputGroup-sizing-default" name="id" >
        <input type="submit" name="eliminar" value="Eliminar" class="btn btn-warning">
    </div>
    <div class="input-group precio_kg">
        <div class="input-group-prepend">
         <span class="input-group-text" id="inputGroup-sizing-default">Precio Kg</span>
        </div>
        <input type="text" class="form-control" aria-label="Fruta" aria-describedby="inputGroup-sizing-default" name="precio_kg" >
    </div>
        <input type="submit" name="modificar" value="Precio Kg" class="btn btn-warning">
    </div>    
    <input type="submit" name="crear" value="Nueva Fruta" class="btn btn-primary">
    <input type="reset" name="cancelar" value="Cancelar" class="btn btn-danger">
    
</form>  
<?php

/* 
 * Cliente REST de Servicio Web de la fruteria
 */
include 'curl_conexion.php';
include 'config.php';
// Crea una CARD de Bootstrap para mostrar los resultados de las búsquedas
$res = '<div class="card" style="width: 18rem;">';
$res .= '<div class="card-body">';
$res .= '<p class="card-text">';
$nom ='';
if(isset($_REQUEST["validar"])){
    if(isset($_REQUEST["temporada"])){
        $temporada= filter_input(INPUT_POST, "temporada", FILTER_SANITIZE_STRING);
        $url = URL . "/index.php?temporada=" . $temporada;
        $res .= '<h5 class="card-title">Frutas de ' . $temporada . '</h5>';
        $response = curl_conexion($url, "GET");
        $frutas = json_decode($response);
        if(count($frutas) > 1){
            for($i = 0 ; $i < count($frutas) ; $i++ ){
                $nom .= 'ID: ' . $frutas[$i][0] . '  Fruta: ' . $frutas[$i][1] . "<br>";
            }
            $res .= $nom;
        }
        else{
            $res .= $frutas;
        }
        $res .= '</p>';
        $res .= '<a href="index.php" class="btn btn-primary">Cerrar</a>';
        $res .= '</div>';
        $res .= '</div>'; 
        echo $res; 
    }
}
if(isset($_REQUEST["validar2"])){
    if(isset($_REQUEST["temporada"]) && isset($_REQUEST["fruta"])){
        $temporada= filter_input(INPUT_POST, "temporada", FILTER_SANITIZE_STRING);
        $fruta = filter_input(INPUT_POST, "fruta", FILTER_SANITIZE_STRING);
        $res .= '<h5 class="card-title">Datos de ' . $fruta . '</h5>';
        $dato ='';
        $url = URL. "/index.php?tempo=" . $temporada . "&fruta=" . $fruta;
        $response = curl_conexion($url, "GET");       
        $frutas = json_decode($response);
        $nom_columna = array('ID', 'FRUTA','PRECIO Kg','TEMPORADA');
        if(is_array($frutas)){
            foreach ($frutas as $fr){
                 foreach ($fr as $campo => $valores) { 
                    $dato .=  $nom_columna[$campo] . ":   " . $valores . "<br>";
                }
            }
            $res .= $dato;
        }
        else{
            $res .= $frutas;
        }
        $res .= '</p>';
        $res .= '<a href="index.php" class="btn btn-primary">Cerrar</a>';
        $res .= '</div>';
        $res .= '</div>';
        echo $res;
    }
}    
if(isset($_REQUEST["crear"])){ // Dar de alta nueva fruta
    header("Location: crear.php");
}
if(isset($_REQUEST["modificar"])){
    if(isset($_REQUEST["id"]) && isset($_REQUEST["precio_kg"])){
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
        $precio_kg = filter_input(INPUT_POST, "precio_kg", FILTER_SANITIZE_STRING);
        $params = array('id' => $id, 'precio_kg' => $precio_kg) ;
        $url = URL. "/index.php";
        $response = curl_conexion($url, "PUT", $params);
        $resp = json_decode($response);
        $res .= $resp;
        $res .= '</p>';
        $res .= '<a href="index.php" class="btn btn-primary">Cerrar</a>';
        $res .= '</div>';
        $res .= '</div>'; 
        echo $res;
    }
}
if(isset($_REQUEST["eliminar"])){
    if(isset($_REQUEST["id"])) {
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
        $url = URL. "/index.php?id=" .$id;
        $response = curl_conexion($url, "DELETE");
        $resp = json_decode($response);
        $res .= $resp;
        $res .= '</p>';
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
