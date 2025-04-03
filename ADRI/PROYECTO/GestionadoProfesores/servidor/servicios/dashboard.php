<?php
session_start();

// Comprobamos si hay sesión activa
if (!isset($_SESSION['rol'])) {
    header('Location: login.html');
    exit();
}

// Accedemos al rol del usuario
$rol = $_SESSION['rol'];
$nombre = $_SESSION['nombre'] . " " . $_SESSION['apellido1'] . $_SESSION['apellido2'];
$documento = $_SESSION['document'];
$foto = $_SESSION['foto'];
$sesiones = isset($_SESSION['sesiones']) ? $_SESSION['sesiones'] : [];
$fechaHoy = $_SESSION['fecha_hoy'] ?? date('d/m/Y');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal de <?php echo $nombre;?></title>
    <link rel="stylesheet" href="../../cliente/src/principal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid justify-content-between align-items-center">

        <!-- Logo de la aplicación -->
        <a class="navbar-brand p-0 m-0" href="#">
            <img src="../../cliente/src/images/logoenUno.png" alt="Logo AsistGuard" class="logo-navbar">
        </a>

        <!-- Botón para móviles -->
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Enlaces -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarContent">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Página principal</a></li>
                <li class="nav-item"><a class="nav-link" href="../../cliente/guardiasRealizadas.html">Guardias realizadas</a></li>

                <?php if ($rol === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="../../cliente/registroAusencias.html">Registrar Ausencia</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../cliente/consultaAusencias.html">Consultar ausencias</a></li>
                <?php endif; ?>
            </ul>

            <!-- Bienvenida y logout -->
            <div class="ms-auto d-flex align-items-center">
                <p id="bienvenida" class="mb-0 me-3">Bienvenid@ <?php echo $nombre; ?></p>
                <form method="POST" action="logout.php">
                    <button type="submit" class="btn btn-sm btn-danger">Cerrar sesión</button>
                </form>


            </div>
        </div>
    </div>
</nav>
<main><div class="container mt-5">
  <div class="d-flex flex-wrap justify-content-between align-items-start 
              flex-md-row flex-column text-md-start text-center">

    <!-- Columna izquierda: foto + datos -->
    <div class="d-flex flex-column align-items-center align-items-md-start mx-auto mx-md-0"
         style="max-width: 400px; width: 100%;">
         
      <!-- Formulario de foto -->
      <form action="subida_fotos.php" method="POST" enctype="multipart/form-data">
        <label for="inputFoto" class="foto-hover">
          <img src="../uploads/<?= htmlspecialchars($foto); ?>?t=<?= time(); ?>" class="foto-circular mb-3">
          <div class="overlay-text">Subir imagen</div>
        </label>
        <input type="file" name="foto" id="inputFoto" accept="image/*" onchange="this.form.submit()" hidden>
      </form>

      <!-- Datos -->
      <p><strong>Documento:</strong> <?= htmlspecialchars($documento); ?></p>
      <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre); ?></p>
      <p><strong>Rol:</strong> <?= htmlspecialchars($rol); ?></p>
    </div>

    <!-- Columna derecha: botones + alerta -->
    <div class="d-flex flex-column align-items-end mt-3 mt-md-0">
      <div class="d-flex gap-2 mb-2">
        <form action="fichajes.php" method="POST">
          <input type="hidden" name="accion" value="entrada">
          <button type="submit" class="btn btn-success">Iniciar fichaje</button>
        </form>

        <form action="fichajes.php" method="POST">
          <input type="hidden" name="accion" value="salida">
          <button type="submit" class="btn btn-danger">Finalizar fichaje</button>
        </form>
      </div>

      <?php if (isset($_SESSION['mensaje_fichaje'])): ?>
        <div class="alert alert-info text-end w-100" style="max-width: 300px;">
          <?= $_SESSION['mensaje_fichaje']; unset($_SESSION['mensaje_fichaje']); ?>
        </div>
      <?php endif; ?>
    </div>

  </div>
</div>


</main>

<section class="container mt-5">
    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th><?= $fechaHoy ?></th>
                    <th>Sesión</th>
                    <th>Curso</th>
                    <th>Aula</th>
                    <th>Asignatura</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($_SESSION['sesiones'])): ?>
                    <?php foreach ($_SESSION['sesiones'] as $sesion): ?>
                        <tr>
                            <td><?= htmlspecialchars($sesion['sesion']) ?></td>
                            <td><?= htmlspecialchars($sesion['curso']) ?></td>
                            <td><?= htmlspecialchars($sesion['aula']) ?></td>
                            <td><?= htmlspecialchars($sesion['asignatura']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay sesiones hoy.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>