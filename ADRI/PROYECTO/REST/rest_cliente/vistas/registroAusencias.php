<?php
session_start();
include("../curl_conexion.php");
$rol = $_SESSION['rol'];

$params = [
    'accion' => 'consultaProfes'
];
$response = curl_conexion(URL, 'POST', $params); // Realizamos la consulta usando POST

// Decodificar la respuesta JSON
$profesores = json_decode($response, true);

// Verificar si hay errores en la respuesta
if (isset($profesores['error'])) {
    $_SESSION['mensaje'] = ['type' => 'danger', 'text' => $profesores['error']];
} else {
    $_SESSION['profesores'] = $profesores;
}

// Verificar si el usuario está autenticado y tiene permisos de administrador
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php"); // Redirigir si no es un admin
    exit();
}

// Obtener los datos de los profesores desde la sesión
$profesores = $_SESSION['profesores'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Ausencia</title>
    <link rel="stylesheet" href="../src/principal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Estilo específico para el formulario */
        .form-container {
            max-width: 800px;
            margin: 50px auto;
        }

        .form-container .form-group {
            margin-bottom: 20px;
        }

        .form-container .btn {
            width: 100%;
        }
    </style>
</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid justify-content-between align-items-center">
        <!-- Logo de la aplicación -->
        <a class="navbar-brand p-0 m-0" href="#">
            <img src="../src/images/sinFondoDos.png" alt="Logo AsistGuard" class="logo-navbar">
        </a>

        <!-- Botón para móviles -->
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Enlaces -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
        <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Página principal</a></li>
                <li class="nav-item"><a class="nav-link" href="guardiasRealizadas.php">Guardias realizadas</a></li>
                  <li class="nav-item"><a class="nav-link" href="consultaAusencias.php">Consultar ausencias</a></li>

                <?php if ($rol === 'admin'): ?>
                  <li class="nav-item"><a class="nav-link" href="registroAusencias.php" id="registrarAusencia">Registrar Ausencia</a></li>
                  <li class="nav_item"><a href="consultaAusenciaEnfecha.php" class="nav-link">Consultar falta por fecha</a></li>
                  <?php endif; ?>
            </ul> 

            <!-- Bienvenida y logout -->
            <div class="ms-auto d-flex align-items-center">
                <p id="bienvenida" class="mb-0 me-3">Bienvenid@ <?php echo $_SESSION['nombre']; ?></p>
                <form method="POST" action="../logout.php">
                    <button type="submit" class="btn btn-sm btn-danger">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Formulario para registrar la ausencia -->
<main>
    <div class="container mt-5 form-container">
        <h3 class="mb-3 text-center">Registrar Ausencia de Profesor</h3>
        <form action="../obtenerSesiones.php" method="POST">
            <div class="form-group">
                <label for="profesor">Seleccionar Profesor</label>
                <select id="profesor" name="document" class="form-control" required>
                    <option value="">Seleccione un profesor</option>
                    <?php foreach ($profesores as $profesor): ?>
                        <option value="<?php echo $profesor[0]; ?>"><?php echo htmlspecialchars($profesor[1]); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="form-group">
                <label for="fecha">Fecha de la Ausencia</label>
                <input type="date" id="fecha" name="fecha" class="form-control">
            </div>

            <div class="form-group">
                <label for="motivo">Motivo de la Ausencia</label>
                <textarea id="motivo" name="motivo" class="form-control" rows="4" placeholder="Escriba el motivo de la ausencia"></textarea>
            </div>

            <button type="submit" class="btn btn-danger mt-3">Registrar Ausencia</button>
        </form>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var fechaInput = document.getElementById('fecha'); // Asegúrate de que el id coincida con el de tu input
        fechaInput.addEventListener('input', function() {
            var date = new Date(fechaInput.value);
            var day = date.getDay(); // 0: Domingo, 6: Sábado

            // Verificar si es sábado (6) o domingo (0)
            if (day === 0 || day === 6) {
                alert('Los fines de semana no son válidos.');
                fechaInput.value = ''; // Limpiar el valor si es fin de semana
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
