<?php
session_start();

// Comprobamos si hay sesión activa
if (!isset($_SESSION['rol'])) {
    header('Location: login.html');
    exit();
}

// Accedemos al rol del usuario
$rol = $_SESSION['rol'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido1'] . $_SESSION['apellido2'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal de <?php echo $nombre;?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/principal.css">

</head>
<body>
    
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid justify-content-between align-items-center">

        <!-- Logo de la aplicación -->
        <a class="navbar-brand mx-auto" href="#">
            <img src="src/images/logoenUno.jpg" alt="Logo AsistGuard" class="logo-navbar">
        </a>

        <!-- Botón para móviles -->
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Enlaces -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Página principal</a></li>
                <li class="nav-item"><a class="nav-link" href="guardiasRealizadas.html">Guardias realizadas</a></li>

                <?php if ($rol === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="registroAusencias.html">Registrar Ausencia</a></li>
                    <li class="nav-item"><a class="nav-link" href="consultaAusencias.html">Consultar ausencias</a></li>
                <?php endif; ?>
            </ul>

            <!-- Bienvenida y logout -->
            <div class="ms-auto d-flex align-items-center">
                <p id="bienvenida" class="mb-0 me-3">Bienvenid@ <?php echo $nombre . " " . $apellido; ?></p>
                <form method="POST" action="logout.php">
                    <button type="submit" class="btn btn-sm btn-danger">Cerrar sesión</button>
                </form>


            </div>
        </div>
    </div>
</nav>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>