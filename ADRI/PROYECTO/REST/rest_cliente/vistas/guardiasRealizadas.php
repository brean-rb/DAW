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
    <title>Pagina principal de <?php echo htmlspecialchars($nombre); ?></title>
    <link rel="stylesheet" href="../src/principal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
<h4 class="mb-3">Guardias realizadas</h4>
<div class="d-flex justify-content-center mb-4">
    <form action="../verGuardiasRealizadas.php" method="POST" class="w-75">
        <div class="d-flex justify-content-between gap-3">
            <div class="flex-fill">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="flex-fill">
                <label for="hora" class="form-label">Hora:</label>
                <input type="time" id="hora" name="hora" class="form-control">
            </div>
            <div class="d-flex align-items-end">
                <button type="submit" name="cargar_guardias" id="cargar_guardias" class="btn btn-primary w-100">Ver mis Guardias</button>
            </div>
        </div>
    </form>
</div>


<!-- Tabla responsiva -->
<?php if (isset($_SESSION['historial']) && is_array($_SESSION['historial']) && empty($_SESSION['error'])): ?>
    <div class="table-responsive">
  <table class="table table-bordered table-striped text-center align-middle">
    <thead class="table-dark">
      <tr>
        <th>Fecha</th>
        <th>Sesión</th>
        <th>Aula</th>
        <th>Grupo</th>
        <th>Asignatura</th>
        <th>Docente Ausente</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($_SESSION['historial'] as $registro): ?>
      <tr>
        <td><?= htmlspecialchars($registro[1] ?? '-'); ?></td>
        <td><?= htmlspecialchars($registro[8] ?? '-'); ?></td>
        <td><?= htmlspecialchars($registro[5] ?? '-'); ?></td>
        <td><?= htmlspecialchars($registro[6] ?? '-'); ?></td>
        <td><?php echo htmlspecialchars($registro[7] ?? '-'); ?></td>
        <td><?= htmlspecialchars($registro[3] ?? '-'); ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php else: ?>

  <div class="alert alert-info mt-4 text-center mx-auto" style="max-width: 600px;">
    No has realizado ninguna guardia todavía.
  </div>
<?php endif; ?>

</section>
<script>
<script>
    window.onload = function(){
        document.getElementById('cargar_guardias').click();
    }
</script>

</script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
