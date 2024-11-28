<?php

include("../configuracion/config.php");

try {
    
    if (!$conexion) {
        throw new Exception("Error de conexion");
    } else {
        // punto 1
        $res1 = mysqli_query($conec, 'SELECT * FROM precios ORDER BY precio_kg ASC');
        if ($res1) {
            $texto1 = "Muestra las frutas ordenadas por precios de menor a mayor.";
            write_table($res1, $texto1);
        } else {
            throw new Exception("Error al ejecutar la consulta para ordenar los precios.");
        }
        // fin punto 1

        // punto 2
        $res2 = mysqli_query($conec, 'SELECT * FROM precios WHERE precio_kg > 1.50');
        if ($res2) {
            $texto2 = "Las frutas que valen más de 1.50 euros/kg.";
            write_table($res2, $texto2);
        } else {
            throw new Exception("Error al ejecutar la consulta para precios mayores a 1.50 euros/kg.");
        }
        // fin punto 2

        // punto 3
        $res3 = mysqli_query($conec, 'SELECT * FROM precios WHERE temporada = "otoño"');
        if ($res3) {
            $texto3 = "Las frutas que solo se venden en otoño.";
            write_table($res3, $texto3);
        } else {
            throw new Exception("Error al ejecutar la consulta para las frutas de otoño.");
        }
        // fin punto 3

        // punto 4
        $res4 = mysqli_query($conec, 'SELECT * FROM precios WHERE temporada = "otoño" OR temporada = "anual"');
        if ($res4) {
            $texto4 = "Las frutas que solo se venden en otoño y anual.";
            write_table($res4, $texto4);
        } else {
            throw new Exception("Error al ejecutar la consulta para frutas de otoño y anual.");
        }
        // fin punto 4

        // punto 5
        $res5 = mysqli_query($conec, 'SELECT * FROM precios WHERE temporada = "anual" AND precio_kg < 0.5');
        if ($res5) {
            $texto5 = "Las frutas que están a la venta todo el año y que cuestan menos de 0.50 euros/kg.";
            write_table($res5, $texto5);
        } else {
            throw new Exception("Error al ejecutar la consulta para frutas anuales con precio menor a 0.50 euros/kg.");
        }
        // fin punto 5
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    @mysqli_close($conec);
}

function write_table($r, $t) {
    echo "<h3 style='text-align: center;'>". $t ."</h3>";
    echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #f2f2f2;'>";
            echo "<th style='border: 1px solid #ddd; padding: 8px;'>Fruta</th>";
            echo "<th style='border: 1px solid #ddd; padding: 8px;'>Precio/kg</th>";
            echo "<th style='border: 1px solid #ddd; padding: 8px;'>Temporada</th>";
        echo "</tr>";

        while ($r_array = mysqli_fetch_assoc($r)) {
            echo "<tr>";
                echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $r_array['fruta'] . "</td>";
                echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $r_array['precio_kg'] . "</td>";
                echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $r_array['temporada'] . "</td>";
            echo "</tr>";
        }

    echo "</table>";
}

?>
