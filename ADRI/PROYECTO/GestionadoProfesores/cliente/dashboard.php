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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal de <?php echo $nombre;?></title>
    <link rel="stylesheet" href="src/principal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    
<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid justify-content-between align-items-center">

        <!-- Logo de la aplicación -->
        <a class="navbar-brand p-0 m-0" href="#">
            <img src="src/images/sinFondoDos.png" alt="Logo AsistGuard" class="logo-navbar">
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
                <p id="bienvenida" class="mb-0 me-3">Bienvenid@ <?php echo $nombre; ?></p>
                <form method="POST" action="logout.php">
                    <button type="submit" class="btn btn-sm btn-danger">Cerrar sesión</button>
                </form>


            </div>
        </div>
    </div>
</nav>
<main>
  <div class="container mt-5 text-center">
    <div class="foto-wrapper mx-auto mb-3">
      <form action="subir_foto.php" method="POST" enctype="multipart/form-data">
        <label for="inputFoto" class="foto-hover">
          <img src="src/images/<?php echo htmlspecialchars($foto); ?>" alt="Foto de perfil" class="foto-circular">
          <div class="overlay-text">Subir imagen</div>
        </label>
        <input type="file" name="foto" id="inputFoto" accept="image/*" onchange="this.form.submit()" hidden>
      </form>
    </div>

    <p><strong>Documento:</strong> <?php echo htmlspecialchars($documento); ?></p>
    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
    <p><strong>Rol:</strong> <?php echo htmlspecialchars($rol); ?></p>
  </div>
</main>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>