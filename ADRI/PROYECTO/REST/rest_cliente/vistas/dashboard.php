<?php
session_start();

$rol = $_SESSION['rol'];
$nombre = $_SESSION['nombre'];
$documento = $_SESSION['document'];
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : null;
if (isset($_SESSION['registro_exitoso']) && $_SESSION['registro_exitoso']) {
  // Eliminar la variable de sesión después de usarla
  unset($_SESSION['registro_exitoso']);
  $mostrarModal = true; // Establecer una variable para mostrar el modal en JavaScript
} else {
  $mostrarModal = false;
}
unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
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
        /* Estilo para el contenedor del mensaje */
        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 300px; /* Ancho del mensaje */
            z-index: 9999; /* Asegura que el mensaje esté por encima de otros elementos */
            overflow: hidden; /* Evita que el texto se desborde del contenedor */
        }

        /* Opcional: Estilo para los mensajes de alerta */
        .alert-container .alert {
            padding: 15px;
            font-size: 14px; /* Ajusta el tamaño del texto */
            text-align: center;
            white-space: normal; /* Permite que el texto se divida en varias líneas */
            word-wrap: break-word; /* Rompe las palabras largas que no caben en una línea */
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
    <?php if ($mensaje): ?>
        <div class="alert-container">
            <div class="alert alert-<?php echo htmlspecialchars($mensaje['type']); ?> text-center" id="mensajeAlert">
                <?php echo htmlspecialchars($mensaje['text']); ?>
            </div>
        </div>
    <?php endif; ?>
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
            <th>Día</th>
            <th>Aula</th>
            <th>Grupo</th>
            <th>Asignatura</th>
            <th>Sesion</th>
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
              <td><?= htmlspecialchars($sesion[6] ?? '-') ?></td>

            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <br>
      <div class="d-flex justify-content-center">
        <form action="../fichar.php" method="POST">
          <button class="btn btn-primary mx-3 w-auto" name="fentrada" id="fentrada">Fichar entrada</button>
        </form>
        <form action="../fichar.php" method="POST">
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
<!-- Modal de confirmación -->
<div class="modal fade" id="modalConfirmacion" tabindex="-1" aria-labelledby="modalConfirmacionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalConfirmacionLabel">Registro realizado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        El registro de ausencia se ha realizado satisfactoriamente.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php if ($mostrarModal): ?>
    <!-- Mostrar el modal automáticamente después de 5 segundos -->
    <script>
        // Mostrar el modal después de 5 segundos
        setTimeout(function() {
            var myModal = new bootstrap.Modal(document.getElementById("modalConfirmacion"));
            myModal.show();
        }, 1000); // 5000 milisegundos = 5 segundos
    </script>
<?php endif; ?>
<script src="../src/app.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script para eliminar el mensaje después de 5 segundos -->
<script>
    setTimeout(function() {
        var alertElement = document.getElementById('mensajeAlert');
        if (alertElement) {
            alertElement.style.display = 'none';
        }
    }, 5000); 

    document.getElementById('registrarAusencia').addEventListener('click', function(event) {
      const params = {
        accion: 'consultaProfes' // La acción que se va a realizar
    };
    });
</script>

</body>
</html>
