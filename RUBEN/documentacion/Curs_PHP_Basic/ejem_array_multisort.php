<?php
/* Ejemplo de ordenación de un array bidimensional 
 * con la función array_multisort, este ordena arrays
 * con una dimensión y la información la interpreta 
 * como organizada en columnas, si al obtenemos por
 * filas, como es el caso de recuperar información
 * de una BD, la debemos transformar para ordenarla
*/

/* Ejercicios de la fruteria Tema 4 Curso PHP Básico*/

	$con = @mysqli_connect("localhost", "root", "root", "fruteria");
        
        if(!$con){ //Si error en conexion, acaba
		die("Error al conectar a la base de datos: $bd_sev  $bd " . mysqli_error($con));
        }
	$consulta = "SELECT * FROM precios";
	$res = mysqli_query($con, $consulta);
	$datos = mysqli_fetch_all($res, MYSQLI_ASSOC);
	
	// Pasamos los datos de filas a columnas	
	foreach ($datos as $clave => $fila) {
    		$id[$clave] = $fila['id'];
    		$fruta[$clave] = $fila['fruta'];
		$precio_kg[$clave] = $fila['precio_kg']; 
		$temporada[$clave] = $fila['temporada'];
	}
	echo "Sin ordenar por precio:<br>";
	foreach ($datos as $clave => $fila ) { // Mostramos el original
		echo $fila['id'] . " " . $fila['fruta'] . " " . $fila['precio_kg'] . " " . $fila['temporada'] . "<br>" ;
	}
	echo "<br>Ordenado por precio:<br>";

	array_multisort($precio_kg, SORT_DESC, $datos); //Ordena por el precio, se pueden añadir más criterios

	foreach ($datos as $clave => $fila ) { // Mostramos el ordenado
		echo $fila['id'] . " " . $fila['fruta'] . " " . $fila['precio_kg'] . " " . $fila['temporada'] . "<br>" ;
	}
?>
