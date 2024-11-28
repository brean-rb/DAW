<?php

    include("../configuracion/config.php");
    

    try {
        if(!$conexion){
            throw new Exception("Error de conexion");
        }else{
            // 4.7.1 
            $sql = "SELECT * FROM jugadores ORDER BY partidos DESC, puntos ASC, rebotes DESC,  asistencias ASC";
            $res = mysqli_query($conec, $sql);
            $text = "Lista de jugadores ordenados por estadísticas";
            write_table($res, $text);
            // 4.7.1 fin 

            // 4.7.2.1
            $sql = "SELECT * FROM jugadores WHERE puntos > 12";
            $res = mysqli_query($conec, $sql);
            $text = "Jugadores con mas de 12 puntos";
            write_table($res, $text);
            // 4.7.2.1 fin 
            
            // 4.7.2.2
            $sql = "SELECT * FROM jugadores WHERE rebotes > 6";
            $res = mysqli_query($conec, $sql);
            $text = "Jugadores con mas de 6 rebotes";
            write_table($res, $text);
            // 4.7.2.2 fin

            // 4.7.2.3
            $sql = "SELECT * FROM jugadores WHERE asistencias > 5";
            $res = mysqli_query($conec, $sql);
            $text = "Jugadores con mas de 5 asistencias";
            write_table($res, $text);
            // 4.7.2.3 fin 

            // 4.7.3
            $sql = "SELECT * FROM jugadores WHERE puntos > 10 AND rebotes >= 4 AND asistencias >= 4";
            $res = mysqli_query($conec, $sql);
            $text = "Jugadores completo";
            write_table($res, $text);
            // 4.7.3 fin

            // 4.7.4.1
            $sql = "SELECT * FROM jugadores WHERE posicion = 'base' AND asistencias > 8";
            $res = mysqli_query($conec, $sql);
            $text = "Bases con mas de 8 asistencias por partido";
            write_table($res, $text);
            // 4.7.4.1 fin

            // 4.7.4.2
            $sql = "SELECT * FROM jugadores WHERE (posicion = 'escolta' OR posicion = 'alero') AND puntos > 15";
            $res = mysqli_query($conec, $sql);
            $text = "Escoltas o aleros que anotan más de 15 puntos por partido.";
            write_table($res, $text);
            // 4.7.4.2 fin

            // 4.7.4.3
            $sql = "SELECT * FROM jugadores WHERE (posicion = 'ala pivot' OR posicion = 'pivot') AND rebotes > 7";
            $res = mysqli_query($conec, $sql);
            $text = "Ala pivots o pivots que cogen más de 7 rebotes por partido.";
            write_table($res, $text);
            // 4.7.4.3 fin

            // 4.8.1
            $sql = "DELETE FROM jugadores WHERE nombre IN ('Juanfran', 'Carter');";
            $res = mysqli_query($conec, $sql);
            // 4.8.1 fin

            // 4.8.2
            $sql = "INSERT INTO jugadores (nombre, posicion, partidos, puntos, rebotes, asistencias)
                    VALUES 
                    ('Jofre', 'alero', 0, 0, 0, 0),
                    ('Lehman', 'ala pivot', 0, 0, 0, 0),
                    ('Stevenson', 'pivot', 0, 0, 0, 0);";
            $res = mysqli_query($conec, $sql);
            // 4.8.2 fin
        }
    }catch (Exception $e) {
        echo $e->getMessage();
    } finally {
        @mysqli_close($conec);
    }

    function write_table($r, $t) {
        if ($r && mysqli_num_rows($r) > 0) {
            // Título de la tabla
            echo "<h3 style='text-align: center; font-family: Arial, sans-serif; color: #333; margin-bottom: 20px;'>" . htmlspecialchars($t) . "</h3>";
    
            // Estilo de la tabla
            echo "<table style='
                    width: 100%; 
                    border-collapse: collapse; 
                    font-family: Arial, sans-serif; 
                    margin-bottom: 20px; 
                    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);'>
                    <thead style='background-color: #4CAF50; color: white;'>
                        <tr>
                            <th style='padding: 10px; text-align: left; border-bottom: 2px solid #ddd;'>Nombre</th>
                            <th style='padding: 10px; text-align: left; border-bottom: 2px solid #ddd;'>Posición</th>
                            <th style='padding: 10px; text-align: left; border-bottom: 2px solid #ddd;'>Partidos</th>
                            <th style='padding: 10px; text-align: left; border-bottom: 2px solid #ddd;'>Puntos/partido</th>
                            <th style='padding: 10px; text-align: left; border-bottom: 2px solid #ddd;'>Rebotes/partido</th>
                            <th style='padding: 10px; text-align: left; border-bottom: 2px solid #ddd;'>Asistencias/partido</th>
                        </tr>
                    </thead>
                    <tbody>";
            
            // Filas de la tabla
            while ($row = mysqli_fetch_assoc($r)) {
                echo "<tr style='background-color: #f9f9f9; border-bottom: 1px solid #ddd;'>
                        <td style='padding: 10px;'>" . htmlspecialchars($row['nombre']) . "</td>
                        <td style='padding: 10px;'>" . htmlspecialchars($row['posicion']) . "</td>
                        <td style='padding: 10px;'>" . htmlspecialchars($row['partidos']) . "</td>
                        <td style='padding: 10px;'>" . htmlspecialchars($row['puntos']) . "</td>
                        <td style='padding: 10px;'>" . htmlspecialchars($row['rebotes']) . "</td>
                        <td style='padding: 10px;'>" . htmlspecialchars($row['asistencias']) . "</td>
                    </tr>";
            }
    
            echo "</tbody></table>";
    
        } else {
            throw new Exception("No hay datos disponibles");
        }
    }
    

?>


