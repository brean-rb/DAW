<?php
session_start();
$rol = $_SESSION['rol'];
$nombre = $_SESSION['nombre'];
$documento = $_SESSION['document'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal de <?php echo $nombre;?></title>
    <link rel="stylesheet" href="../src/principal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <p id="bienvenida" class="mb-0 me-3">Bienvenid@ <?php echo $nombre; ?></p>
                <form method="POST" action="../logout.php">
                    <button type="submit" class="btn btn-sm btn-danger">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main>
    <div class="container mt-5 d-flex justify-content-start align-items-center perfil-contenedor">
        <div class="foto-wrapper me-4">
            <img src="../src/images/default.jpg" alt="Foto de perfil" class="foto-circular">
        </div>

        <div class="info-usuario text-start">
            <p><strong>Documento:</strong> <?php echo htmlspecialchars($documento); ?></p>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
            <p><strong>Rol:</strong> <?php echo htmlspecialchars($rol); ?></p>
        </div>
    </div>
</main>
<section>
<div class="container mt-4">
<h4 class="mb-3">Guardias pendientes de hoy:</h4>
<form action="../verAusencias.php" method="POST">
    <button type="submit" class="btn btn-primary">Cargar Guardias</button>
  </form>
<!-- Tabla responsiva -->
<div class="table-responsive">
      <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
          <tr>
            <th>Sesion</th>
            <th>Aula</th>
            <th>Grupo</th>
            <th>Asignatura</th>
            <th>Docente Ausente</th>
          </tr>
        </thead>
        <tbody>
            <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
            </tr>
            </tbody>
      </table>
      <?php// else: ?>
  <div class="alert alert-info mt-4 text-center mx-auto" style="max-width: 600px;">
  No hay ninguna guardia pendiente.
</div>
<?php //endif; ?>
</section>
<script src="../src/app.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
