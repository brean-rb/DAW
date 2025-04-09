<?php
session_start();

$rol = $_SESSION['rol'];
$nombre = $_SESSION['nombre'];
$documento = $_SESSION['document'];
$fecha = $_SESSION["fechaAusencia"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de registro de ausencias</title>
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
<?php if (!empty($_SESSION["sesiones_profesor"])): ?>
  <div class="container mt-4">
  <h4 class="mb-3">Sesiones del <?php echo htmlspecialchars($fecha); ?></h4>

  <!-- Mostrar horas seleccionadas en una fila -->
  <div class="row mb-3">
  <form action="../guardarAusencia.php" method="POST">
    <!-- Campos ocultos para enviar las horas -->
<input type="hidden" name="hora_inicio" id="hora_inicio">
<input type="hidden" name="hora_fin" id="hora_fin">


  <!-- Tabla responsiva -->
  <div class="table-responsive">
    <table class="table table-bordered table-striped text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>Hora</th>
          <th>Día</th>
          <th>Aula</th>
          <th>Grupo</th>
          <th>Asignatura</th>
          <th>Sesion</th>
          <th>Seleccionar</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION["sesiones_profesor"] as $index => $sesion): ?>
          <tr id="fila-<?php echo $index; ?>">
            <td><?= htmlspecialchars($sesion[1] . ' - ' . $sesion[2]) ?></td>
            <td><?= htmlspecialchars($sesion[0] ?? '-') ?></td>
            <td><?= htmlspecialchars($sesion[5] ?? '-') ?></td>
            <td><?= htmlspecialchars($sesion[4] ?? '-') ?></td>
            <td><?= htmlspecialchars($sesion[3] ?? '-') ?></td>
            <td><?= htmlspecialchars($sesion[6] ?? '-') ?></td>
            <td>
            <input type="checkbox" class="checkboxSesion" name="sesiones[]" value="<?php echo $sesion[1] . ' - ' . $sesion[2]; ?>">
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="form-check">
          <input type="checkbox" class="form-check-input" id="jornada_completa" name="jornada_completa">
          <label class="form-check-label" for="jornada_completa">Seleccionar todas las sesiones</label>
        </div>
    <br>
    <div class="d-flex justify-content-center">
      
        <button class="btn btn-primary mx-3 w-auto" name="guardarAusencia" id="guardarAusencia">Registrar Ausencia</button>
      </form>
      <a href="dashboard.php" class="btn btn-danger mx-3 w-auto">Volver</a>
    </div>
  </div>
</div>

<?php else: ?>
  <div class="alert alert-info mt-4 text-center mx-auto" style="max-width: 600px;">
    Hoy no tienes sesiones asignadas.
  </div>
  <?php endif; ?>
  
  <script src="../src/ausencias.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
