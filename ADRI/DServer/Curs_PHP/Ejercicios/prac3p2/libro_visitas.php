<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de visitas</title>
</head>
<body>
    <h1>Libro de visitas: </h1>
    <?php

    require("./bibliotecas/listarvisitas.php");
    listar_visita("/opt/lampp/htdocs/practicaphp/prac3p2/visitas.txt" , "r");
   ?>
    <a href="nueva_visita.php">Nueva visita</a>
</body>
</html>