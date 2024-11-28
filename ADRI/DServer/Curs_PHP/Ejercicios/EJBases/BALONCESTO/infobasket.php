<?php
include("conexion.php");

try {
    if (!$conex) {
    throw new Exception("Error en la conexion a la base de datos");
}else{
    //4.7 ESTADISTICAS DE JUGADORES
    function crearTabla($result,$titulo){
        if ($result && mysqli_num_rows($result) > 0){
            echo "<h3>" . $titulo ."</h3>";
            echo "<table style = 'border-collapse:collapse; border: 3px dotted blue; background-color: gray;color:white ;text-align:center;'>";
            echo "<tr>";
            echo "<th style = 'border: 3px dashed blue;'>Jugador</th>";
            echo "<th style = 'border: 3px dashed blue;'>Posición</th>";
            echo "<th style = 'border: 3px dashed blue;'>Par.Jugados</th>";
            echo "<th style = 'border: 3px dashed blue;'>Puntos</th>";
            echo "<th style = 'border: 3px dashed blue;'>Rebotes</th>";
            echo "<th style = 'border: 3px dashed blue;'>Asistencias</th>";
            echo "</tr>";

            while ($resultado = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $resultado["nombre"] ."</td>";
                echo "<td>" . $resultado["posicion"] ."</td>";
                echo "<td>" . $resultado["partidos"] ."</td>";
                echo "<td>" . $resultado["puntos"] ."</td>";
                echo "<td>" . $resultado["rebotes"] ."</td>";
                echo "<td>" . $resultado["asistencias"] ."</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
            
        }else {
                echo "No hay datos disponibles o consulta mal realizada<br>";
            }
    }

    // 4.7.1 Lista de jugadores ordenados segun su cantidad de partidos, puntos, rebotes y asistencias

    $select = "SELECT * FROM jugadores ORDER BY partidos DESC, puntos ASC, rebotes DESC, asistencias ASC;";
}   $result = mysqli_query($conex,$select);
    crearTabla($result, "Jugadores ordenados segun su cantidad de partidos, puntos, rebotes y asistencias");

    // 4.7.2.1 Lista de jugadores que han anotado mas de 12 puntos

    $select = "SELECT * FROM jugadores WHERE puntos > 12.0;";
    $result = mysqli_query($conex,$select);
    crearTabla($result,"Jugadores con mas de 12 puntos");

    // 4.7.2.2 Lista de jugadores que han cogido mas de 6 rebotes

    $select = "SELECT * FROM jugadores WHERE rebotes > 6;";
    $result = mysqli_query($conex,$select);
    crearTabla($result, "Jugadores con mas de 6 rebotes");

    // 4.7.2.3 Lista de jugadores que han dado mas de 5 asistencias

    $select = "SELECT * FROM jugadores WHERE asistencias > 5;";
    $result = mysqli_query($conex,$select);
    crearTabla($result, "Jugadores con mas de 5 asistencias");

    //4.7.3 Jugadores completos( > 10 puntos, => 4 rebotes, => 4 asistencias)

    $select = "SELECT * FROM jugadores WHERE puntos > 10 AND rebotes >= 4 AND asistencias >= 4;";
    $result = mysqli_query($conex,$select);
    crearTabla($result, "Jugadores completos");

    // 4.7.4.1 Jugadores base que dan mas de 8 asistencias

    $select = "SELECT * FROM jugadores WHERE posicion = 'base' AND asistencias > 8;";
    $result = mysqli_query($conex,$select);
    crearTabla($result, "Bases con mas de 8 asistencias");

    // 4.7.4.2 Escoltas o aleros que consiguen mas de 15 puntos por partido

    $select = "SELECT * FROM jugadores WHERE (posicion = 'escolta' OR posicion = 'alero') AND puntos > 15;";
    $result = mysqli_query($conex,$select);
    crearTabla($result, "Aleros o Escoltas con mas de 15 puntos");

    // 4.7.4.3 Ala pivots o pivots que cojen mas de 7 rebotes por partido

    $select = "SELECT * FROM jugadores WHERE (posicion = 'ala pivot' OR posicion = 'pivot') AND rebotes > 7;";
    $result = mysqli_query($conex,$select);
    crearTabla($result, "Ala pivots o pivots con mas de 7 rebotes");
    
    //4.8.1 Modificar tabla para indicar que JuanFran y Carter estan de baja

   $delete1 = "DELETE FROM jugadores WHERE nombre='JuanFran'";
   $delete2 = "DELETE FROM jugadores WHERE nombre='Carter'";

   $result1 = mysqli_query($conex,$delete1);
   $result2 = mysqli_query($conex,$delete2);
   $datoseliminados = mysqli_affected_rows($conex);
   if ($datoseliminados === 1) {
    echo "<p><strong>Jugadores dados de baja correctamente</strong></p>";
   } else{
    echo"<p><strong>Error a dar de baja</strong></p>";
   }

   //4.8.2 Fichar a  Jofre - alero, Lehman - ala pivot y a Stevenson -Pivot

//    $insert = "INSERT INTO jugadores (nombre,posicion,partidos,puntos,rebotes,asistencias) VALUES 
//    ('Jofre','alero',0,0,0,0),
//    ('Lehman','ala pivot',0,0,0,0),
//    ('Stevenson','pivot',0,0,0,0);";

//    $result = mysqli_query($conex,$insert);
//    if ($result) {
//     $colsaffect = mysqli_affected_rows($conex);
//     if ($colsaffect === 3) {
//        echo "<p><strong>Insercion correcta</strong></p>";
//     } else{
//         echo "<p><strong>Error en la insercion</strong></p>";
//     }
//     }
} catch (Exception $e) {
    echo $e->getMessage();
}
