<?php
include 'conexion.php';

try {
    if (!$conex) {
        throw new Exception("Error al conectarse a la base de datos");
    }else{

        function mostrarTabla($result, $titulo) {
            if ($result && $result->rowCount() > 0) {
                echo "<h3 style='color: #2c3e50; text-align:center; font-size: 24px;'>$titulo</h3>";
                echo "<table style='width: 100%; border-collapse: collapse; margin-top: 10px;'>";
                echo "<tr style='background-color: #f2f2f2;'>";
                echo "<th style='border: 1px solid #ddd; padding: 8px;'>Nombre Fruta</th>";
                echo "<th style='border: 1px solid #ddd; padding: 8px;'>Precio_Kg</th>";
                echo "<th style='border: 1px solid #ddd; padding: 8px;'>Temporada</th>";
                echo "</tr>";

                while ($resultado = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td style='border: 1px solid #ddd; text-align:center; padding: 8px;'>" . htmlspecialchars($resultado["fruta"]) . "</td>";
                    echo "<td style='border: 1px solid #ddd; text-align:center; padding: 8px;'>" . htmlspecialchars($resultado["precio_kg"]) . "</td>";
                    echo "<td style='border: 1px solid #ddd; text-align:center; padding: 8px;'>" . htmlspecialchars($resultado["temporada"]) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='text-align:center; font-weight:bold;'>No hay datos disponibles o error en la consulta.</p>";
            }
        }
        // 4.3 Muestra las frutas ordenadas de menor a mayor

        $sql ="SELECT * FROM precios ORDER BY precio_kg ASC";
        $res =$conex->query($sql);
        if ($res) {
            mostrarTabla($res,"Ordenar frutas de mayor a menor");            
        }
    }
} catch ( Exception $e) {
    echo $e->getMessage();
}