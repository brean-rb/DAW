<?php
/**
 * loginView.php
 *
 * Muestra la pantalla de inicio de sesión:
 * - Recupera y muestra errores de login guardados en sesión.
 * - Presenta el formulario para documento y contraseña.
 * - Incluye lógica de estilo e importación de scripts.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 *
 * @var string|null $error Mensaje de error de login obtenido de la sesión.
 */

session_start();                          // Inicia o reanuda la sesión
$error = $_SESSION["error_login"] ?? null; // Obtiene mensaje de error, si existe
unset($_SESSION["error_login"]);          // Elimina el mensaje para no mostrarlo repetido
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="src/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="src/styles.css">
    <style>
      /* Estilos globales y de fondo */
      * { box-sizing: border-box; }
      html, body { height: 100%; margin: 0; padding: 0; overflow: hidden; }
      body {
        background: linear-gradient(135deg, #0f1f2d, #18362f);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
      }
      #logo { margin-top: 50px; }
    </style>
</head>
<body>
    <!-- Elemento para mostrar fecha y hora actual -->
    <div class="fecha-actual text-center mt-3"></div>

    <!-- Logo centrado -->
    <div class="text-center">
        <img id="logo" src="src/images/logoenUno2.png" alt="Logo de AsistGuard">
    </div>

    <!-- Caja de login -->
    <div class="login-box">
        <h2 class="text-center mb-4">Iniciar sesión</h2>

        <!-- Muestra alerta si hay error de login -->
        <?php if ($error): ?>
            <div class="alert alert-danger text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de login -->
        <form method="POST" action="inicioSesion.php">
            <!-- Campo Documento -->
            <div class="mb-3">
                <label for="document" class="form-label">Número de documento</label>
                <input type="text"
                       class="form-control"
                       id="document"
                       name="document"
                       placeholder="12345678Z"
                       required>
            </div>

            <!-- Campo Contraseña con botón para mostrar/ocultar -->
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password"
                           class="form-control"
                           id="password"
                           name="password"
                           placeholder="••••••••"
                           required>
                    <button type="button"
                            class="btn btn-outline-secondary"
                            id="togglePassword">
                        <span id="eyeIcon">👁️</span>
                    </button>
                </div>
            </div>

            <!-- Botón de envío -->
            <div class="d-grid">
                <button type="submit"
                        name="validar"
                        class="btn btn-gradient">
                    Entrar
                </button>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="src/app.js"></script> <!-- Lógica de fecha y toggle de contraseña -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
