<?php

    include("configuracion/config.php");

    try {
        
        if(!$conexion){
            throw new Exception("Error de conexion");
            
        } else{
            $res = mysqli_query($conec, 'SELECT * FROM precios ORDER BY precio_kg ASC');

            if($res){
                echo "<table>";
                    echo "<tr>";
                        echo "<th>fruta</th>";
                        echo "<th>precio_kg</th>";
                        echo "<th>temporada</th>";
                    echo "</tr>";

                    while($res_array = mysqli_fetch_assoc($res)){

                            echo "<tr>";
                            echo "<td>" . $res_array['fruta'] ."</td>";
                            echo "<td>" . $res_array['precio_kg'] . "</td>";
                            echo "<td>" . $res_array['temporada'] . "</td>";
                            echo "</tr>";
                        
                    }

                echo "</table>";
            }
        }
        
    } catch (Exception $e) {
        echo $e->getMessage();

    } finally {
        @mysqli_close($conec);
    }

?>