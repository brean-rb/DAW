<?php
include("conexion.php");

try {
    if (!$conex) {
        throw new Exception("Error en la conexion a la base de datos");
    } else {
        $select = "SELECT * FROM precios ORDER BY precio_kg";
        $result = mysqli_query($conex, $select);
       
        if ($result) {
            echo "<h3>FRUTAS</h3>";
            echo "<table>";
            echo "<tr>";
            echo "<th>ID fruta</th>";
            echo "<th>Nombre Fruta</th>";
            echo "<th>Precio_Kg</th>";
            echo "<th>Temporada</th>";
            echo "</tr>";

            while ($resultado = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $resultado["fruta"] . "</td>";
                echo "<td>" . $resultado["precio_kg"] . "</td>";
                echo "<td>" . $resultado["temporada"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
        } else {
            echo "Error en la muestra de frutas";
            mysqli_close($conex);
        }
        mysqli_close($conex);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
