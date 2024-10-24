<?php
    include("fecha.php");

    if((isset($_POST["date"])) && !empty($_POST["date"])){
        $change = strtotime($_POST["date"]);
        $date = date("d/m/Y", $change);

        $day = substr($date,0,2);
        $barra = strpos($date, "/");
        $month = substr($date, $barra + 1,2);
        $year = substr($date, 6,10);

        $mi_fecha = new fecha($day, $month, $year);

        echo $mi_fecha;

    } else {
        echo "fecha erronia";
    }
?>