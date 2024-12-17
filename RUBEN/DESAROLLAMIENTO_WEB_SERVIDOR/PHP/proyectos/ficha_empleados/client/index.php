<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div>
            <label for="">nombre</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="">telefono</label>
            <input type="text" name="tel" id="tel">
        </div>
        <div>
            <label for="">nif</label>
            <input type="text" name="nif" id="nif">
        </div>
        <div>
            <label for="">suledo</label>
            <input type="text" name="seld" id="seld">
        </div>
        <input type="submit" name="mostra" value="empleado">
        <input type="submit" name="alta" value="nuevo">
        <input type="submit" name="borrar" value="eliminar">
    </form>
</body>

    <?php
        include "CONFIG\config.php";
        include "CONFIG\curl_conect_server.php";

        $result = "";

        $name = $_POST["name"];
        $telefon = $_POST["tel"];
        $nif = $_POST["nif"];
        $salary = $_POST["seld"];

        try {
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                if($_REQUEST["mostrar"]){
                    if(!empty($nif)){
                        $url = URL_SERVER. "?nif=" . $nif;
                        $responde = curl_conect( $url ,"GET");
                        $result = json_decode($responde, TRUE);
                    } else{
                        throw new Exception("Debe introducir el campo NIF para mostrar");
                    }

                } elseif ($_REQUEST["alta"]){
                    if(!empty($name), !empty($telefon), !empty($nif), !empty($salary)){
                        $params = ["nombre" => $name,
                                    "telefono" => $telefon,
                                    "nif" => $nif,
                                    "suldo" = $salary];
                        $response = curl_conect($url, "POST", $params);
                        $result = json_decode($responde, TRUE);
                    } else{
                        $resultado = "Debe rellenar todos los campos para dar de alta.";
                    }

                } elseif ($_SERVER["borrar"]){
                    if(!empty("nif")){
                        $url = URL_SERVER . "?nif=" . $nif;
                        $responde = curl_conect($url, "DELETE");
                        $result = json_decode($responde, TRUE);
                    } else{
                        throw new Exception("Debe introducir el campo NIF para mostrar");
                    }
                }
            }
        } catch (Exeception $e) {
            $resultado = "error: " . $e.getMessage();
        }

        echo $resultado;
    ?>
</html>

