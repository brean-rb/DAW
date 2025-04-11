<?php
session_start();
include("../curl_conexion.php");
$rol = $_SESSION['rol'];
$nombre = $_SESSION['nombre'];
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal de <?php echo htmlspecialchars($nombre); ?></title>
    <link rel="stylesheet" href="../src/principal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
    
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid justify-content-between align-items-center">
        <a class="navbar-brand p-0 m-0" href="dashboard.php">
            <img src="../src/images/sinFondoDos.png" alt="Logo AsistGuard"  class="logo-navbar">
        </a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="guardiasRealizadas.php">Guardias Realizadas</a></li>
                <li class="nav-item"><a class="nav-link" href="consultaAusencias.php">Consultar Ausencias</a></li>
                <?php if ($rol === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="registroAusencias.php" id="registrarAusencia">Registrar Ausencia</a></li>
                    <li class="nav-item"><a href="consultaAusenciaEnfecha.php" class="nav-link">Consultar Falta Por Fecha</a></li>
                <?php endif; ?>
            </ul>
            <div class="ms-auto d-flex align-items-center">
    <p id="bienvenida" class="mb-0 me-3">Bienvenid@ <?php echo htmlspecialchars($nombre); ?></p>
    <form method="POST" action="../logout.php">
        <button type="submit" class="btn btn-sm btn-danger" title="Cerrar sesión">
            <i class="bi bi-box-arrow-right"></i>
        </button>
    </form>
</div>

        </div>
    </div>
</nav>


<!-- Formulario para registrar la ausencia -->
<main>
    <div class="container mt-5 form-container">
        <h3 class="mb-3 text-center">Registrar Ausencia de Profesor</h3>
        <form action="../obtenerSesiones.php" id="busqueda"  method="POST">
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
                <input type="date" id="fecha" name="fecha" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="form-group">
                <label for="motivo">Motivo de la Ausencia</label>
                <textarea id="motivo" name="motivo" class="form-control" rows="4" placeholder="Escriba el motivo de la ausencia"></textarea>
            </div>

            <button type="submit" class="btn btn-danger mt-3">Buscar sesiones</button>
        </form>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#busqueda');
    const fechaInput = document.getElementById('fecha');

    form.addEventListener('submit', function (event) {
        const fechaSeleccionada = fechaInput.value;

        if (!fechaSeleccionada) return; // por si no se ha seleccionado nada

        const date = new Date(fechaSeleccionada);
        const day = date.getDay(); // Domingo = 0, Sábado = 6

        if (day === 0 || day === 6) {
            alert('Los fines de semana no son válidos.');
            event.preventDefault(); // ⚠️ Evita enviar el formulario
        }
    });
});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
