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
} catch (Exception $e) {
    echo $e->getMessage();
}
