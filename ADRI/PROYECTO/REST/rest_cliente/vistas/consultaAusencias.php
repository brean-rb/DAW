<?php
/**
 * Página principal del dashboard.
 * Gestiona la sesión del usuario y muestra la interfaz con navegación, perfil y guardias pendientes.
 */

// Inicia o continúa la sesión para acceder a $_SESSION
session_start();

// Si no hay usuario autenticado, redirige al login
if (!isset($_SESSION['document'])) {
    header("Location: ../login.php");
    exit();
}

// Recupera datos de sesión para personalizar la vista
$rol       = $_SESSION['rol'];       // Rol del usuario (e.g. 'admin', 'user')
$nombre    = $_SESSION['nombre'];    // Nombre completo del usuario
$documento = $_SESSION['document'];  // Identificador único del usuario
$usuarioId = $_SESSION['document'];  // Mismo identificador, usado donde se requiera ID

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Metadatos básicos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal de <?php echo htmlspecialchars($nombre); ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../src/images/favicon.png" type="image/x-icon">

    <!-- Bootstrap CSS y iconos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS personalizado -->
    <link rel="stylesheet" href="../src/principal.css">

    <!-- Estilos inline para ocultar scrollbar y personalizar navbar-toggler -->
    <style>
        /* Ocultar scrollbars en WebKit */
        ::-webkit-scrollbar { display: none; }

        /* Botón hamburguesa con fondo oscuro y borde blanco */
        .navbar-toggler {
            background-color: #0f1f2d !important;
            border: 2px solid #fff !important;
        }
        .navbar-toggler-icon {
          /* Icono de tres barras blancas */
          background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' d='M4 7H26 M4 15H26 M4 23H26'/%3E%3C/svg%3E");
        }
        .navbar-toggler:hover {
          /* Color distinto al pasar el ratón */
          background-color: #18362f !important;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- NAVBAR: navegación superior fija -->
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container-fluid">

        <!-- LOGO: vuelve al dashboard al hacer clic -->
        <a class="navbar-brand" href="dashboard.php">
          <img src="../src/images/sinFondoDos.png" alt="Logo AsistGuard" class="logo-navbar">
        </a>

        <!-- BOTÓN HAMBURGUESA: colapsa/expande el menú en pantallas pequeñas -->
        <button class="navbar-toggler bg-light" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENÚ COLAPSABLE -->
        <div class="collapse navbar-collapse" id="navbarContent">
          <!-- ENLACES CENTRALES -->
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link text-white" href="guardiasRealizadas.php?auto=1">
                Guardias Realizadas
              </a>
            </li>
            <li class="nav-item">
              <a id="link-cargar-guardias" class="nav-link text-white"
                 href="../verAusencias.php?cargar_guardias=1">
                Consultar Ausencias
              </a>
            </li>

            <?php if ($rol === 'admin'): ?>
              <!-- Opciones adicionales para administradores -->
              <li class="nav-item">
                <a class="nav-link text-white" href="verInformes.php">
                  Generar informes
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#"
                   role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Gestión de asistencia
                </a>
                <ul class="dropdown-menu dropdown-hover">
                  <li><a class="dropdown-item" href="verAsistencia.php">Consultar asistencia</a></li>
                  <li><a class="dropdown-item" href="registroAusencias.php">Registrar Ausencia</a></li>
                </ul>
              </li>
            <?php endif; ?>
          </ul>

          <!-- SALUDO y LOGOUT al final de la barra -->
          <div class="d-flex align-items-center ms-auto">
            <span class="text-white me-3">
              <strong>Bienvenid@ <?= htmlspecialchars($nombre); ?></strong>
            </span>
            <form method="POST" action="../logout.php" class="mb-0">
              <button class="btn btn-sm btn-outline-light"
                      style="background:linear-gradient(135deg, #1e3a5f, #0f1f2d);"
                      title="Cerrar sesión">
                <i class="bi bi-box-arrow-right"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <main>
      <div class="container mt-5">
        <!-- PERFIL: foto y datos del usuario -->
        <div class="perfil-contenedor d-flex flex-column flex-md-row
                    align-items-center justify-content-between mb-4">
          <div class="d-flex align-items-center mb-3 mb-md-0">
            <div class="foto-wrapper me-4">
              <img src="../src/images/default.jpg" alt="Foto de perfil" class="foto-circular">
            </div>
            <div class="info-usuario text-start">
              <p><strong>Documento:</strong> <?php echo htmlspecialchars($documento); ?></p>
              <p><strong>Nombre:</strong>    <?php echo htmlspecialchars($nombre); ?></p>
              <p><strong>Rol:</strong>       <?php echo htmlspecialchars($rol); ?></p>
            </div>
          </div>
          <!-- BOTONES de acceso rápido (p.ej. chat) -->
          <div class="botones-usuario d-flex align-items-center gap-2 text-center text-md-end">
            <!-- Enlace al chat interno -->
            <a href="chat.php" class="btn btn-primary d-flex align-items-center justify-content-center"
               style="border:2px solid; background:linear-gradient(135deg, #1e3a5f, #0f1f2d);">
              <i class="bi bi-chat-dots-fill fs-4"></i>
              <span class="ms-2 d-none d-md-inline">Chat</span>
            </a>
          </div>
        </div>

        <!-- MENSAJE FLASH: mostrarse sólo una vez si existe $mensaje -->
        <?php if (isset($mensaje)): ?>
          <div class="alert-container">
            <div class="alert alert-<?php echo htmlspecialchars($mensaje['type']); ?> text-center" id="mensajeAlert">
              <?php echo htmlspecialchars($mensaje['text']); ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </main>

    <!-- SECCIÓN: Guardias pendientes de hoy -->
    <section>
      <div class="d-flex justify-content-center mb-3">
        <!-- Botón para recargar guardias manualmente -->
        <form action="../verAusencias.php" method="GET">
          <button type="submit" name="cargar_guardias" class="btn btn-primary"
                  style="background:linear-gradient(135deg, #1e3a5f, #0f1f2d);border:0;">
            Cargar Guardias
          </button>
        </form>
      </div>

      <?php if (!empty($_SESSION["guardiasPen"])): ?>
        <!-- Tabla responsiva con sesiones pendientes -->
        <div class="container mt-4">
          <h4 class="mb-3">
            Guardias pendientes de hoy (<?php echo htmlspecialchars(date('d-m-Y')); ?>):
          </h4>
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
                    <!-- Datos de la sesión -->
                    <td><?php echo htmlspecialchars($sesion[0] ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($sesion[1] ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($sesion[2] ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($sesion[3] ?? '-'); ?></td>
                    <td><?php echo htmlspecialchars($sesion[5] ?? '-'); ?></td>
                    <td>
                      <?php if ($sesion[6] == 0): ?>
                        <!-- Pendiente: muestra badge y botón modal -->
                        <span class="badge bg-danger align-items-center me-2">Pendiente</span>
                        <button class="badge bg-warning btn-sm"
                                style="border:0;"
                                data-bs-toggle="modal"
                                data-bs-target="#coverGuardModal"
                                data-sesion="<?php echo htmlspecialchars(
                                  'Sesión: ' . $sesion[0] .
                                  ' - Aula: ' . $sesion[1] .
                                  ' - Grupo: ' . $sesion[2] .
                                  ' - Asignatura: ' . $sesion[3]
                                ); ?>"
                                data-sesion-id="<?php echo htmlspecialchars($sesion[0]); ?>"
                                data-document="<?php echo htmlspecialchars($sesion[4]); ?>">
                          Cubrir Guardia
                        </button>
                      <?php else: ?>
                        <!-- Ya asignada -->
                        <span class="badge bg-success align-items-center me-2">Asignado</span>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php else: ?>
        <!-- Mensaje si no hay guardias pendientes -->
        <div class="alert alert-info mt-4 text-center fw-bold">
          <i class="bi bi-exclamation-triangle-fill"></i>
          No hay guardias pendientes
        </div>
      <?php endif; ?>

      <!-- Modal: Confirmación cobertura de guardia -->
      <div class="modal fade" id="coverGuardModal" tabindex="-1"
           aria-labelledby="coverGuardModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="coverGuardModalLabel">
                Confirmar cobertura de la guardia
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"
                      aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p id="sesion-info"><!-- Aquí se inyecta la sesión seleccionada --></p>
            </div>
            <div class="modal-footer">
              <!-- Botón cancelar -->
              <button type="button" class="btn btn-secondary"
                      data-bs-dismiss="modal"
                      style="border:2px solid; background:linear-gradient(135deg, #1e3a5f, #0f1f2d);">
                Cancelar
              </button>
              <!-- Form para asignarse la guardia -->
              <form action="../verAusencias.php" method="POST" class="d-inline">
                <input type="hidden" id="sesion_id_input" name="sesion_id" value="">
                <input type="hidden" id="document_input"  name="document"   value="">
                <input type="hidden" name="asignar"  value="1">
                <input type="hidden" name="redirigir" value="1">
                <button type="submit" class="btn btn-primary"
                        id="confirm-cover"
                        style="border:2px solid; background:linear-gradient(135deg, #0f1f2d, #18362f);">
                  Asignarme guardia
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Notificación emergente tras asignar guardia -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
      <div class="position-fixed top-0 start-50 translate-middle-x mt-4"
           style="z-index:1050; width:100%; max-width:500px;">
        <div class="alert alert-primary text-center fw-bold mb-0" role="alert">
          Guardia asignada correctamente. Pulsa 👇 para ver los cambios.
        </div>
      </div>
    <?php endif; ?>

    <!-- Scripts -->
    <script src="../src/guardias.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FOOTER con información de copyright -->
    <footer class="bg-dark text-white py-4 mt-auto"
            style="background:linear-gradient(135deg, #0f1f2d, #18362f) !important;">
      <div class="container text-center">
        <p class="mb-0">&copy; 2025 AsistGuard. Todos los derechos reservados.</p>
        <p>
          <!-- Enlaces a redes sociales -->
          <a href="https://www.instagram.com/" style="color:white; text-decoration:none;">
            <img src="../src/images/instagram.png" alt="Instagram" width="24" height="24">
          </a> |
          <a href="https://www.facebook.com/?locale=es_ES" style="color:white; text-decoration:none;">
            <img src="../src/images/facebook.png" alt="Facebook" width="24" height="24">
          </a> |
          <a href="https://x.com/?lang=es" style="color:white; text-decoration:none;">
            <img src="../src/images/twitter.png" alt="Twitter" width="24" height="24">
          </a> |
          <a href="https://es.linkedin.com/" style="color:white; text-decoration:none;">
            <img src="../src/images/linkedin.png" alt="LinkedIn" width="24" height="24">
          </a>
        </p>
      </div>
    </footer>
</body>
</html>
