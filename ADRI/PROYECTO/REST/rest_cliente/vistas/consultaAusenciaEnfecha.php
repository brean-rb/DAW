<?php
session_start();
$rol = $_SESSION['rol'];
$nombre = $_SESSION['nombre'];
$documento = $_SESSION['document'];
$guardias = $_SESSION["guardiasFecha"] ?? [];

$tieneGuardias = is_array($guardias) && count($guardias) > 0 && (!isset($guardias["error"]) || !$guardias["error"]);
$busquedaHecha = $_SESSION["busquedaGuardiasRealizada"] ?? false;

error_log("tieneGuardias: " . ($tieneGuardias ? 'true' : 'false'));
error_log("guardias: " . print_r($guardias, true));
error_log("busquedaHecha: " . ($busquedaHecha ? 'true' : 'false'));

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
        <form action="../verAusenciasEnFecha.php" method="GET">
            <div class="input-group">
                <input type="date" class="form-control" name="fecha" required value="<?php echo isset($_SESSION["fechaFalta"]) && !empty($_SESSION["fechaFalta"]) ? htmlspecialchars(date('Y-m-d', strtotime($_SESSION["fechaFalta"]))) : date('Y-m-d'); ?>">
                <div class="mx-2"></div>
                <button type="submit" name="cargar_guardias_porFecha" class="btn btn-primary">Cargar Guardias</button>
            </div>
        </form>
    </div>
    <?php if ($tieneGuardias): ?>
        <div class="container mt-4">
            <h4 class="mb-3">Guardias pendientes de: <?php echo isset($_SESSION["fechaFalta"]) ? htmlspecialchars(date('d-m-Y', strtotime($_SESSION["fechaFalta"]))) : ''; ?></h4>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Sesión</th>
                            <th>Aula</th>
                            <th>Grupo</th>
                            <th>Asignatura</th>
                            <th>Docente Ausente</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($guardias as $index => $sesion): ?>
                            <?php if (is_array($sesion) && count($sesion) >= 6): ?>
                                <tr id="fila-<?php echo $index; ?>">
                                    <td><?php echo htmlspecialchars($sesion[0] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($sesion[1] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($sesion[2] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($sesion[3] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($sesion[5] ?? '-'); ?></td>
                                    <td><?php echo isset($sesion[6]) ? htmlspecialchars(date('d-m-Y', strtotime($sesion[6]))) : '-'; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php elseif ($busquedaHecha): ?>
        <?php error_log("No hay datos para la fecha seleccionada."); ?>
    <div class="alert alert-info mt-4 text-center mx-auto" style="max-width: 600px;">
        No hay ninguna guardia pendiente para la fecha seleccionada:
        <strong><?php echo isset($_SESSION['fechaFalta']) ? htmlspecialchars(date('d-m-Y', strtotime($_SESSION['fechaFalta']))) : 'N/A'; ?></strong>
    </div>
<?php endif; ?>
    </section>
    <script>
document.addEventListener('DOMContentLoaded', function() {


    // Validar la fecha para evitar fines de semana
    var fechaInput = document.querySelector('input[type="date"]');
    if (fechaInput) {
        fechaInput.addEventListener('input', function() {
            var date = new Date(fechaInput.value);
            var day = date.getDay(); // 0: Domingo, 6: Sábado

            // Verificar si es sábado (6) o domingo (0)
            if (day === 0 || day === 6) {
                alert('Los fines de semana no son válidos.');
                fechaInput.value = ''; // Limpiar el valor si es fin de semana
            }
        });
    }
});
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>