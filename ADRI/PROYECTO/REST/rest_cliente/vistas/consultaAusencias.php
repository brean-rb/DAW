<?php
session_start();
$rol = $_SESSION['rol'];
$nombre = $_SESSION['nombre'];
$documento = $_SESSION['document'];
if (isset($_GET["error"])) {
    $error = htmlspecialchars($_GET["error"]);
    echo "<div style='color: red; font-weight: bold;'>⚠️ $error</div>";
}
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
    <div class="d-flex justify-content-center mb-3">
        <form action="../verAusencias.php" method="GET">
            <button type="submit" name="cargar_guardias" class="btn btn-primary">Cargar Guardias</button>
        </form>
    </div>
    <?php if (!empty($_SESSION["guardiasPen"])): ?>
        <div class="container mt-4">
            <h4 class="mb-3">Guardias pendientes de hoy (<?php echo htmlspecialchars(date('d-m-Y')); ?>):</h4>
            
            <!-- Formulario para cargar guardias alineado a la derecha -->
            <div class="d-flex justify-content-end mb-3">
                
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Sesión</th>
                            <th>Aula</th>
                            <th>Grupo</th>
                            <th>Asignatura</th>
                            <th>Docente Ausente</th>
                            <th>Guardia asignada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION["guardiasPen"] as $index => $sesion): ?>
                            <tr id="fila-<?php echo $index; ?>">
                                <td><?php echo htmlspecialchars($sesion[0] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($sesion[1] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($sesion[2] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($sesion[3] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($sesion[5] ?? '-'); ?></td>
                                <td>
    <?php if ($sesion[6] == 0): ?>
        <span class="badge bg-danger d-inline-flex align-items-center me-2">Pendiente</span>
        <button 
  class="btn btn-warning btn-sm w-auto w-sm-100" 
  data-bs-toggle="modal" 
  data-bs-target="#coverGuardModal" 
  data-sesion="<?php echo htmlspecialchars('Sesion: ' . $sesion[0] . ' - Aula: ' . $sesion[1] . ' - Grupo: ' . $sesion[2]); ?>"
  data-sesion-id="<?php echo htmlspecialchars($sesion[0]); ?>"
  data-document="<?php echo htmlspecialchars($sesion[4]); ?>">
    Cubrir Guardia
</button>

    <?php else: ?>
        <span class="badge bg-success d-inline-flex align-items-center me-2">Asignado</span>
    <?php endif; ?>
</td>


                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info mt-4 text-center mx-auto" style="max-width: 600px;">
            No hay ninguna guardia pendiente.
        </div>
    <?php endif; ?>

    <!-- Modal de confirmación para cubrir la guardia -->
<div class="modal fade" id="coverGuardModal" tabindex="-1" aria-labelledby="coverGuardModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="coverGuardModalLabel">Confirmar cobertura de la guardia</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="sesion-info"></p> <!-- Aquí se mostrará la sesión que se va a cubrir -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar guardia</button>
        <form action="../verAusencias.php" method="POST" class="d-inline">
    <input type="hidden" id="sesion_id_input" name="sesion_id" value="">
    <input type="hidden" id="document_input" name="document" value="">
    <button type="submit" name="asignar" class="btn btn-primary" id="confirm-cover">Asignarme guardia</button>
</form>


        </div>
    </div>
  </div>
</div>

</section>


<script src="../src/guardias.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
