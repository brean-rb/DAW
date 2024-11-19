<?php

// Configuración de la conexión
$servername = "localhost";
$username = "root"; // Cambia según tu configuración
$password = "";     // Cambia según tu configuración
$dbname = "ejemplo_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa<br>";

// Crear una tabla de ejemplo
$crearTabla = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    email VARCHAR(50),
    edad INT
)";
if ($conn->query($crearTabla) === TRUE) {
    echo "Tabla 'usuarios' creada o ya existe.<br>";
} else {
    echo "Error creando tabla: " . $conn->error;
}

// INSERT: Insertar datos de ejemplo
$insertar = "INSERT INTO usuarios (nombre, email, edad) VALUES 
    ('Juan', 'juan@example.com', 25),
    ('Maria', 'maria@example.com', 30),
    ('Carlos', 'carlos@example.com', 35)";
if ($conn->query($insertar) === TRUE) {
    echo "Datos insertados correctamente.<br>";
} else {
    echo "Error al insertar datos: " . $conn->error;
}

// SELECT: Leer datos
echo "<br><strong>Usuarios registrados:</strong><br>";
$select = "SELECT * FROM usuarios";
$resultado = $conn->query($select);
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "ID: " . $fila["id"] . " - Nombre: " . $fila["nombre"] . " - Email: " . $fila["email"] . " - Edad: " . $fila["edad"] . "<br>";
    }
} else {
    echo "No se encontraron registros.<br>";
}

// UPDATE: Actualizar un dato
$update = "UPDATE usuarios SET edad = 40 WHERE nombre = 'Carlos'";
if ($conn->query($update) === TRUE) {
    echo "Edad actualizada correctamente para Carlos.<br>";
} else {
    echo "Error al actualizar: " . $conn->error;
}

// DELETE: Eliminar un dato
$delete = "DELETE FROM usuarios WHERE nombre = 'Maria'";
if ($conn->query($delete) === TRUE) {
    echo "Usuario Maria eliminado correctamente.<br>";
} else {
    echo "Error al eliminar: " . $conn->error;
}

// Leer nuevamente después de las operaciones
echo "<br><strong>Usuarios después de las modificaciones:</strong><br>";
$resultado = $conn->query($select);
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "ID: " . $fila["id"] . " - Nombre: " . $fila["nombre"] . " - Email: " . $fila["email"] . " - Edad: " . $fila["edad"] . "<br>";
    }
} else {
    echo "No se encontraron registros.<br>";
}

// Cerrar conexión
$conn->close();

