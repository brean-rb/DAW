<?php
/**
 * logout.php
 *
 * Cierra la sesión del usuario y redirige al formulario de login.
 * - Elimina todas las variables de sesión.
 * - Destruye la sesión actual.
 * - Redirige al usuario a login.php.
 *
 * @package    GestionGuardias
 * @author     Adrian Pascual Marschal
 * @license    MIT
 */

session_start();    // Inicia o reanuda la sesión

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión completamente
session_destroy();

// Redirigir al usuario al formulario de login
header("Location: login.php");
exit;
