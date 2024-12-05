<?php

    include("../CONFIG/config.php");

    try {
        if(!$conexion){
            throw new Exception("Error: failed to connect for database");

        } else{
            // 4.3
            $sql = "SELECT * FROM precios ORDER BY precio_kg ASC";
            $res = $conec->query($sql);
            if($res){
                $text = "Muestra las frutas ordenadas por precios de menor a mayor.";
                write_table($res, $text);
            }
            // 4.3 fin
        }
    } catch (Exception $th) {
        echo $th->getMessage();
    }

    function write_table($r, $t) {
        if($r && $r->rowCount() >0){
            echo "<h3 style='text-align: center;'>". $t ."</h3>";
            echo "<table style='border-collapse: collapse; width: 100%;'>";
                echo "<tr style='background-color: #f2f2f2;'>";
                    echo "<th style='border: 1px solid #ddd; padding: 8px;'>Fruta</th>";
                    echo "<th style='border: 1px solid #ddd; padding: 8px;'>Precio/kg</th>";
                    echo "<th style='border: 1px solid #ddd; padding: 8px;'>Temporada</th>";
                echo "</tr>";
        
                while ($r_array = $r->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                        echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $r_array['fruta'] . "</td>";
                        echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $r_array['precio_kg'] . "</td>";
                        echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $r_array['temporada'] . "</td>";
                    echo "</tr>";
                }
        
            echo "</table>";
        } else{
            echo "no hay ningun dato"; 
        }
    }
    
?>