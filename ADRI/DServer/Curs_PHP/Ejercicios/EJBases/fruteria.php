<?php
include("conexion.php");

try {
    if (!$conex) {
        throw new Exception("Error en la conexión a la base de datos");
    } else {

        // Función para mostrar la tabla de resultados
        function mostrarTabla($result, $titulo) {
            if ($result) {
                echo "<h3 style='color: #2c3e50; text-align:center;font-size: 24px;'>$titulo</h3>";
                echo "<table style='width: 100%; border-collapse: collapse; margin-top: 10px;'>";
                echo "<tr style='background-color: #f2f2f2;'>";
                echo "<th style='border: 1px solid #ddd; padding: 8px;'>Nombre Fruta</th>";
                echo "<th style='border: 1px solid #ddd; padding: 8px;'>Precio_Kg</th>";
                echo "<th style='border: 1px solid #ddd; padding: 8px;'>Temporada</th>";
                echo "</tr>";

                while ($resultado = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td style='border: 1px solid #ddd; text-align:center;padding: 8px;'>" . $resultado["fruta"] . "</td>";
                    echo "<td style='border: 1px solid #ddd; text-align:center;padding: 8px;'>" . $resultado["precio_kg"] . "</td>";
                    echo "<td style='border: 1px solid #ddd; text-align:center;padding: 8px;'>" . $resultado["temporada"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                mysqli_free_result($result);
            } else {
                echo "Error en la consulta de datos";
            }
        }

        // Consultas y llamadas a la función mostrarTabla()
        
        // 4.3.1 Ordenar la tabla de frutas según su precio por kg
        $select = "SELECT * FROM precios ORDER BY precio_kg";
        $result = mysqli_query($conex, $select);
        mostrarTabla($result, "FRUTAS");

        // 4.3.2 Frutas que valen más de 1.50€/kg
        $select = "SELECT * FROM precios WHERE precio_kg > 1.50";
        $result = mysqli_query($conex, $select);
        mostrarTabla($result, "FRUTAS CON PRECIO MAYOR A 1.50€/kg");

        // 4.3.3 Frutas vendidas de temporada otoñal
        $select = "SELECT * FROM precios WHERE temporada = 'otoño'";
        $result = mysqli_query($conex, $select);
        mostrarTabla($result, "FRUTAS CON VENTA OTOÑAL");

        // 4.3.4 Frutas vendidas de temporada otoñal (contando con temporada anual)
        $select = "SELECT * FROM precios WHERE temporada = 'otoño' OR temporada = 'anual'";
        $result = mysqli_query($conex, $select);
        mostrarTabla($result, "FRUTAS CON VENTA OTOÑAL (CONTANDO TEMPORADAS ANUALES)");

        // 4.3.5 Frutas vendidas de temporada anual y con precio inferior a 0.50
        $select = "SELECT * FROM precios WHERE temporada = 'anual' AND precio_kg < 0.50";
        $result = mysqli_query($conex, $select);
        mostrarTabla($result, "FRUTAS CON VENTA ANUAL CON PRECIO INFERIOR A 0.50");

        mysqli_close($conex);
    }
} catch (Exception $e) { //Se ejecutará el mensaje si no se realiza la conexión
    echo $e->getMessage();
}
?>
