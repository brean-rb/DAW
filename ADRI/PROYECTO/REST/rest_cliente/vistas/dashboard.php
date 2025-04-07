<?php
session_start();

// Accedemos al rol del usuario
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

                <?php if ($rol === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="registroAusencias.php">Registrar Ausencia</a></li>
                    <li class="nav-item"><a class="nav-link" href="consultaAusencias.php">Consultar ausencias</a></li>
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
<?php if (!empty($_SESSION["sesiones_hoy"])): ?>
  <div class="container mt-4">
    <h4 class="mb-3">Sesiones de hoy</h4>

    <!-- Tabla responsiva -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped text-center align-middle">
        <thead class="table-dark">
          <tr>
            <th>Hora</th>
            <th>Sesion</th>
            <th>Aula</th>
            <th>Grupo</th>
            <th>Asignatura</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($_SESSION["sesiones_hoy"] as $sesion): ?>
            <tr>
              <td><?= htmlspecialchars($sesion[1] . ' - ' . $sesion[2]) ?></td>
              <td><?= htmlspecialchars($sesion[0] ?? '-') ?></td>
              <td><?= htmlspecialchars($sesion[5] ?? '-') ?></td>
              <td><?= htmlspecialchars($sesion[4] ?? '-') ?></td>
              <td><?= htmlspecialchars($sesion[3] ?? '-') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <br>
      <div class="d-flex justify-content-center">
        <form action="../fichar.php" method="post">
          <button class="btn btn-primary mx-3 w-auto" name="fentrada" id="fentrada">Fichar entrada</button>
        </form>
        <form action="../fichar.php" method="post">
          <button class="btn btn-danger mx-3 w-auto" name="fsalida" id="fsalida">Fichar salida</button>
        </form>
      </div>
    </div>
  </div>
<?php else: ?>
  <div class="alert alert-info mt-4 text-center mx-auto" style="max-width: 600px;">
  Hoy no tienes sesiones asignadas.
</div>
<?php endif; ?>

</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>