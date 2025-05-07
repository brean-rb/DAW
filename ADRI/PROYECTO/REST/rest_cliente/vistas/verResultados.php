<?php
/**
 * mostrarInforme.php
 *
 * Muestra los resultados de un informe de faltas filtrado y permite exportarlos a PDF.
 * - Verifica autenticación y permisos de administrador.
 * - Obtiene datos desde la sesión: resultados del informe y tipo de filtro.
 * - Genera la tabla de resultados y el botón de exportación.
 * - Utiliza jsPDF y jsPDF-AutoTable para la exportación a PDF con pie de página y encabezado.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 */

session_start();
/** Inicia o reanuda la sesión para acceder a datos de usuario y resultados almacenados. */

// Verificación de autenticación: redirige al login si no hay usuario en sesión
if (!isset($_SESSION['document'])) {
    header("Location: ../login.php");
    exit();
}

// Recupera datos de usuario desde la sesión
$rol        = $_SESSION['rol'];
$nombre     = $_SESSION['nombre'];
$documento  = $_SESSION['document'];

// Obtiene los resultados del informe y el tipo de filtro usados
$resultados = $_SESSION['resultado_informe'] ?? [];
$tipo       = $_SESSION['tipo_informe']     ?? 'informe';

// Validación: si no hay datos estructurados, muestra alerta y termina
if (empty($resultados) || !isset($resultados[0]) || !is_array($resultados[0])) {
    echo "<div class='alert alert-warning text-center m-5'>⚠️ No hay datos disponibles para mostrar.</div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultados del Informe</title>
  <link rel="shortcut icon" href="../src/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="../src/principal.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="dashboard.php">
      <img src="../src/images/sinFondoDos.png" alt="Logo AsistGuard" class="logo-navbar">
    </a>

    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link text-white" href="guardiasRealizadas.php?auto=1">Guardias realizadas</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="../verAusencias.php?cargar_guardias=1">Consultar ausencias</a></li>

        <?php if ($rol === 'admin'): ?>
          <li class="nav-item"><a class="nav-link text-white" href="verInformes.php">Generar informes</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gestión de asistencia
            </a>
            <ul class="dropdown-menu dropdown-hover">
              <li><a class="dropdown-item" href="verAsistencia.php">Consultar asistencia</a></li>
              <li><a class="dropdown-item" href="registroAusencias.php">Registrar ausencia</a></li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>

      <style>
        
        .table-responsive {
  overflow-x: auto !important;
  -webkit-overflow-scrolling: touch;
}

/* 2) Fuerza que aquí sí se muestre la scrollbar */
.table-responsive::-webkit-scrollbar {
  display: block !important;
  height: 6px;
}
.table-responsive::-webkit-scrollbar-thumb {
  background: rgba(30,58,95,0.8);
  border-radius: 3px;
}
.table-responsive::-webkit-scrollbar-track {
  background: rgba(15,31,45,0.5);
  border-radius: 3px;
}
@media (max-width: 767.98px) {
  .table-responsive table {
    min-width: 700px; /* o el ancho que necesiten tus columnas */
  }
}

::-webkit-scrollbar {display: none; } 
.navbar-toggler {background-color: #0f1f2d !important;  /* tu azul custom */border: 2px solid #fff !important;     /* borde blanco */}

/* 2) Icono: tres barras blancas */
.navbar-toggler-icon {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='white' stroke-width='2' stroke-linecap='round' d='M4 7H26 M4 15H26 M4 23H26'/%3E%3C/svg%3E");
}


.navbar-toggler:hover {
  background-color: #18362f !important;  /* un tono ligeramente distinto si quieres */
}
        
  table {
    table-layout: auto !important;
    width: 100% !important;
  }

  th, td {
    white-space: nowrap;
    word-break: break-word;
    padding: 6px;
    font-size: 11px;
  }

  .table-responsive {
    overflow-x: auto;
  }
  table.table-guardias thead tr th {
background: linear-gradient(135deg, #0f1f2d, #18362f) !important;
color: #fff !important;
}
</style>


      <div class="d-flex align-items-center ms-auto">
        <span class="text-white me-3"><strong>Bienvenid@ <?= htmlspecialchars($nombre); ?></strong></span>
        <form method="POST" action="../logout.php" class="mb-0">
        <button 
  class="btn btn-sm btn-outline-light"
  style="background:linear-gradient(135deg, #1e3a5f, #0f1f2d);" 
  title="Cerrar sesión">
    <i class="bi bi-box-arrow-right"></i>
  </button>
        </form>
      </div>
    </div>
  </div>
</nav>
<main>
  <div class="container mt-5">
    <!-- Perfil: foto + datos a la izquierda, botones a la derecha -->
    <div class="perfil-contenedor 
                d-flex flex-column flex-md-row 
                align-items-center justify-content-between">
      
      <!-- IZQUIERDA: foto + datos -->
      <div class="d-flex align-items-center mb-3 mb-md-0">
        <div class="foto-wrapper me-4">
          <img src="../src/images/default.jpg" alt="Foto de perfil" class="foto-circular">
        </div>
        <div class="info-usuario text-start">
          <p><strong>Documento:</strong> <?php echo htmlspecialchars($documento); ?></p>
          <p><strong>Nombre:</strong> <?php echo htmlspecialchars($nombre); ?></p>
          <p><strong>Rol:</strong> <?php echo htmlspecialchars($rol); ?></p>
        </div>
      </div>
      
     <!-- DERECHA: botones en línea -->
     <div class="botones-usuario d-flex align-items-center gap-2 text-center text-md-end">


  <!-- CHAT -->
  <a 
    href="chat.php" 
    class="btn btn-primary d-flex align-items-center justify-content-center" 
    role="button"
    style=" border: 2px solid; 
   background:linear-gradient(135deg, #1e3a5f, #0f1f2d);"
  >
    <i class="bi bi-chat-dots-fill fs-4"></i>
    <span class="ms-2 d-none d-md-inline">Chat</span>
  </a>
    </div>



    <?php if (isset($mensaje)): ?>
      <div class="alert-container">
        <div class="alert alert-<?php echo htmlspecialchars($mensaje['type']); ?> text-center" id="mensajeAlert">
          <?php echo htmlspecialchars($mensaje['text']); ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</main>

<div class="container mt-5 tabla2PDF">

<div class="mb-4 text-center d-flex justify-content-center align-items-center" id="tituloInforme">
  <img id="iconoInforme" src="../src/images/icono-informe.png" alt="Informe" style="height: 24px; margin-right: 8px;">
  <span style="font-size: 20px;">Informe filtrado por <?= htmlspecialchars($tipo) ?></span>
</div>


  
  <div class="table-responsive ">
    <table class="table table-bordered table-striped text-center align-middle table-guardias">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Profesor ausente</th>
            <th>Profesor guardia</th>
            <th>Aula</th>
            <th>Grupo</th>
            <th>Asignatura</th>
            <th>Sesion</th>
            <th>Dia</th>
            <th>Hora Inicio -- Hora fin</th>
            <th>Guardias totales</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultados as $fila): ?>
            <tr>
                <?php foreach ($fila as $valor): ?>
                    <td><?= htmlspecialchars($valor) ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
  </div>

  
</div>
<div class="mt-4 text-center">
    <a href="verInformes.php" class="btn btn-secondary">⬅️ Volver</a>
  </div>
<!-- Botón flotante para exportar a PDF -->
<button id="exportarPDF"
        class="btn btn-danger position-fixed"
        style="
          right: 20px;
          bottom: 20px;
          z-index: 1000;
          border: 2px solid;
          background: linear-gradient(135deg, #1e3a5f, #0f1f2d);
        ">
  <i class="bi bi-file-earmark-pdf-fill"></i> Exportar a PDF
</button>
<img id="footerLogo" src="../src/images/logoenUno.png" alt="Imagen PDF" style="display:none; max-width: 250px;">

  <!-- 1) Bootstrap Bundle (Popper + Collapse, Dropdowns, etc) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- 2) Tus otros scripts (jsPDF, Flatpickr, inicializadores, etc) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
  <!-- …el resto de tus scripts… -->
</body>
<script>
 document.getElementById("exportarPDF").addEventListener("click", () => {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({ orientation: "landscape", unit: "mm", format: "a4" });

  const footerLogo = document.getElementById("footerLogo");
  const imgFooter = new Image();
  imgFooter.src = footerLogo.src;

  const iconoInforme = document.getElementById("iconoInforme");
  const iconoImg = new Image();
  iconoImg.src = iconoInforme.src;

  iconoImg.onload = function () {
    const pageWidth = doc.internal.pageSize.getWidth();

    const iconW = 10;
    const iconH = 10;
    const spacing = 4;
    const texto = "Informe filtrado por " + <?= json_encode($tipo) ?>;

    doc.setFontSize(14);
    const textWidth = doc.getTextWidth(texto);
    const totalWidth = iconW + spacing + textWidth;
    const startX = (pageWidth - totalWidth) / 2;
    const iconY = 20;
    const textY = iconY + 7;

    // Dibujar icono y texto centrados
    doc.addImage(iconoImg, 'PNG', startX, iconY, iconW, iconH);
    doc.text(texto, startX + iconW + spacing, textY);

    // Extraer datos de la tabla
    const table = document.querySelector("table");
    const head = [];
    const body = [];

    table.querySelectorAll("thead tr").forEach(tr => {
      const row = [];
      tr.querySelectorAll("th").forEach(th => row.push(th.textContent.trim()));
      head.push(row);
    });

    table.querySelectorAll("tbody tr").forEach(tr => {
      const row = [];
      tr.querySelectorAll("td").forEach(td => row.push(td.textContent.trim()));
      body.push(row);
    });

    // Dibujar la tabla
    doc.autoTable({
      head: head,
      body: body,
      startY: 35,
      margin: { top: 30, bottom: 25 },
      styles: { fontSize: 8, halign: 'center', cellPadding: 2 },
      headStyles: { fillColor: [15, 31, 45] },
      didDrawPage: function () {
        const pageHeight = doc.internal.pageSize.height;
        const imgWidth = 40;
        const imgHeight = 15;
        const x = (doc.internal.pageSize.width - imgWidth) / 2;
        const y = pageHeight - imgHeight - 5;
        doc.addImage(imgFooter, 'PNG', x, y, imgWidth, imgHeight);
      }
    });

    doc.save("informe-filtrado.pdf");
  };
});

</script>
</body>
<footer class="bg-dark text-white py-4 mt-5" style="background: linear-gradient(135deg, #0f1f2d, #18362f) !important;">
   <div class="container text-center">
     <p class="mb-0">&copy; 2025 AsistGuard. Todos los derechos reservados.</p>
     <p>
       <a href="https://www.instagram.com/" style="color: white; text-decoration: none;">
         <img src="../src/images/instagram.png" alt="Instagram" width="24" height="24" style="background: transparent;">
       </a> |
       <a href="https://www.facebook.com/?locale=es_ES" style="color: white; text-decoration: none;">
         <img src="../src/images/facebook.png" alt="Facebook" width="24" height="24" style="background: transparent;">
       </a> |
       <a href="https://x.com/?lang=es" style="color: white; text-decoration: none;">
         <img src="../src/images/twitter.png" alt="Twitter" width="24" height="24" style="background: transparent;">
       </a> |
       <a href="https://es.linkedin.com/" style="color: white; text-decoration: none;">
         <img src="../src/images/linkedin.png" alt="LinkedIn" width="24" height="24" style="background: transparent;">
       </a></p>
   </div>
 </footer>
</html>