<?php
include("conexion.php");

try {
    if (!$conex) {
        throw new Exception("Error en la conexión a la base de datos");
    } else {
        
        // Función para mostrar la tabla de resultados
        function mostrarTabla($result, $titulo) {
            if ($result && mysqli_num_rows($result) > 0) {
                echo "<h3 style='color: #2c3e50; text-align:center; font-size: 24px;'>$titulo</h3>";
                echo "<table style='width: 100%; border-collapse: collapse; margin-top: 10px;'>";
                echo "<tr style='background-color: #f2f2f2;'>";
                echo "<th style='border: 1px solid #ddd; padding: 8px;'>Nombre Fruta</th>";
                echo "<th style='border: 1px solid #ddd; padding: 8px;'>Precio_Kg</th>";
                echo "<th style='border: 1px solid #ddd; padding: 8px;'>Temporada</th>";
                echo "</tr>";

                while ($resultado = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td style='border: 1px solid #ddd; text-align:center; padding: 8px;'>" . htmlspecialchars($resultado["fruta"]) . "</td>";
                    echo "<td style='border: 1px solid #ddd; text-align:center; padding: 8px;'>" . htmlspecialchars($resultado["precio_kg"]) . "</td>";
                    echo "<td style='border: 1px solid #ddd; text-align:center; padding: 8px;'>" . htmlspecialchars($resultado["temporada"]) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                mysqli_free_result($result);
            } else {
                echo "<p style='text-align:center; font-weight:bold;'>No hay datos disponibles o error en la consulta.</p>";
            }
        }

        /*
        PRACTICA 4.3
        */

        // 4.3.1 Ordenar la tabla de frutas según su precio por kg
        $select = "SELECT * FROM precios ORDER BY precio_kg";
        $result = mysqli_query($conex, $select);
        if (!$result) {
            echo "<p>Error en la consulta: " . mysqli_error($conex) . "</p>";
        } else {
            mostrarTabla($result, "FRUTAS");
        }

        // 4.3.2 Frutas que valen más de 1.50€/kg
        $select = "SELECT * FROM precios WHERE precio_kg > 1.50";
        $result = mysqli_query($conex, $select);
        if (!$result) {
            echo "<p>Error en la consulta: " . mysqli_error($conex) . "</p>";
        } else {
            mostrarTabla($result, "FRUTAS CON PRECIO MAYOR A 1.50€/kg");
        }

        // 4.3.3 Frutas vendidas de temporada otoñal
        $select = "SELECT * FROM precios WHERE temporada = 'otoño'";
        $result = mysqli_query($conex, $select);
        if (!$result) {
            echo "<p>Error en la consulta: " . mysqli_error($conex) . "</p>";
        } else {
            mostrarTabla($result, "FRUTAS CON VENTA OTOÑAL");
        }

        // 4.3.4 Frutas vendidas de temporada otoñal (contando con temporada anual)
        $select = "SELECT * FROM precios WHERE temporada = 'otoño' OR temporada = 'anual'";
        $result = mysqli_query($conex, $select);
        if (!$result) {
            echo "<p>Error en la consulta: " . mysqli_error($conex) . "</p>";
        } else {
            mostrarTabla($result, "FRUTAS CON VENTA OTOÑAL (CONTANDO TEMPORADAS ANUALES)");
        }

        // 4.3.5 Frutas vendidas de temporada anual y con precio inferior a 0.50
        $select = "SELECT * FROM precios WHERE temporada = 'anual' AND precio_kg < 0.50";
        $result = mysqli_query($conex, $select);
        if (!$result) {
            echo "<p>Error en la consulta: " . mysqli_error($conex) . "</p>";
        } else {
            mostrarTabla($result, "FRUTAS CON VENTA ANUAL CON PRECIO INFERIOR A 0.50");
        }

        /*
         * PRACTICA 4.4
        */

        // 4.4.1 Añade las frutas: melones - 0.80 euros/kg - verano, naranjas – 1.50 euros/kg - invierno.
        $insert = "INSERT INTO precios (fruta, precio_kg, temporada) VALUES
        ('Melones', 0.8, 'verano'),
        ('Naranjas', 1.5, 'invierno');";
        $result = mysqli_query($conex, $insert);
        if ($result) {
            echo "<p style='text-align:center; font-weight:bold;'>Nuevos datos insertados</p>";
        } else {
            echo "<p style='text-align:center; font-weight:bold;'>Error al insertar: " . mysqli_error($conex) . "</p>";
        }

        // 4.4.2 Elimina la fruta manzanas
        $delete = "DELETE FROM precios WHERE fruta = 'Manzana'";
        $result = mysqli_query($conex, $delete);
        if ($result) {
            echo "<p style='text-align:center; font-weight:bold;'>Datos eliminados correctamente</p>";
        } else {
            echo "<p style='text-align:center; font-weight:bold;'>Error al borrar: " . mysqli_error($conex) . "</p>";
        }

        // 4.4.3 Modificar precio de melones a 0.60
        $update = "UPDATE precios SET precio_kg = 0.60 WHERE fruta = 'Melones'";
        $result = mysqli_query($conex, $update);
        if ($result) {
            echo "<p style='text-align:center; font-weight:bold;'>Precio modificado correctamente</p>";
        } else {
            echo "<p style='text-align:center; font-weight:bold;'>Error al modificar el precio: " . mysqli_error($conex) . "</p>";
        }

        // 4.4.4 Cambiar la temporada de las naranjas a anual
        $update = "UPDATE precios SET temporada = 'anual' WHERE fruta = 'Naranjas';";
        $result = mysqli_query($conex, $update);
        if ($result) {
            echo "<p style='text-align:center; font-weight:bold;'>Temporada modificada correctamente</p>";
        } else {
            echo "<p style='text-align:center; font-weight:bold;'>Error al modificar la temporada: " . mysqli_error($conex) . "</p>";
        }
        
        // Cerrar la conexión al final
        mysqli_close($conex);
    }
} catch (Exception $e) { 
    echo "<p>Error en la conexión: " . $e->getMessage() . "</p>";
}
?>
