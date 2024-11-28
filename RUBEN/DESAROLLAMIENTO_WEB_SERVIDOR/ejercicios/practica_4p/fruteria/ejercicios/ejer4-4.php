<?php

include("../configuracion/config.php");

try {
    
    if (!$conexion) {
        throw new Exception("Error de conexion");
    } else {
        // punto 1
        $sql1 = "INSERT INTO precios (fruta, precio_kg, temporada) VALUES
                ('Melones', 0.80, 'verano'),
                ('Naranjas', 1.50, 'invierno');";
        $res1 = mysqli_query($conec, $sql1);

        if ($res1) {
            echo "Las frutas Melones y Naranjas se añadieron correctamente.<br>";
        } else {
            echo "Error al añadir las frutas Melones y Naranjas: " . mysqli_error($conec) . "<br>";
        } 
        // fin punto 1

        // punto 2
        $sql2 = "DELETE FROM precios WHERE fruta = 'Manzanas';";
        $res2 = mysqli_query($conec, $sql2);

        if ($res2) {
            echo "La fruta Manzanas se eliminó correctamente.<br>";
        } else {
            echo "Error al eliminar la fruta Manzanas: " . mysqli_error($conec) . "<br>";
        } 
        // fin punto 2

        // punto 3
        $sql3 = "UPDATE precios SET precio_kg = 0.60 WHERE fruta = 'Melones';";
        $res3 = mysqli_query($conec, $sql3);

        if ($res3) {
            echo "El precio de los Melones se actualizó correctamente a 0.60 euros/kg.<br>";
        } else {
            echo "Error al actualizar el precio de los Melones: " . mysqli_error($conec) . "<br>";
        } 
        // fin punto 3

        // punto 4
        $sql4 = "UPDATE precios SET temporada = 'anual' WHERE fruta = 'Naranjas';";
        $res4 = mysqli_query($conec, $sql4);

        if ($res4) {
            echo "La temporada de las Naranjas se actualizó correctamente a anual.<br>";
        } else {
            echo "Error al actualizar la temporada de las Naranjas: " . mysqli_error($conec) . "<br>";
        } 
        // fin punto 4
    }

} catch (Exception $e) {
    echo "Excepción capturada: " . $e->getMessage();
} finally {
    @mysqli_close($conec);
}

?>
