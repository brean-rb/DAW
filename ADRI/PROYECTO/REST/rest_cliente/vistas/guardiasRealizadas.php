<?php
session_start();

// Accedemos al rol del usuario
$rol = $_SESSION['rol'];
$nombre = $_SESSION['nombre'];
$documento = $_SESSION['document'];
?>
<pre>
<?php print_r($_SESSION["sesiones_hoy"]); ?>
</pre>