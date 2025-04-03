<?php
include('../config/config.php');
session_start();

$dniProfesor = $_SESSION['document'];

// Día actual
$dias = ['D', 'L', 'M', 'X', 'J', 'V', 'S'];
$diaSemana = date('w');
$dia_actual = $dias[$diaSemana];

$sesiones = [];
$fechaHoy = date('d/m/Y') . " ($dia_actual)"; // Formato: 03/04/2025 (J)

if ($diaSemana > 0 && $diaSemana < 6) {
    $sql = "
        SELECT 
            horari_grup.sessio_orde AS sesion,
            horari_grup.curs AS curso,
            horari_grup.aula AS aula,
            continguts.nom_cas AS asignatura
        FROM horari_grup
        INNER JOIN continguts ON horari_grup.contingut = continguts.codi
        WHERE horari_grup.dia_setmana = '$dia_actual'
        AND horari_grup.docent = '$dniProfesor'
        ORDER BY horari_grup.hora_desde ASC
    ";

    $resultado = mysqli_query($conexion_db, $sql);

    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $sesiones[] = $fila;
        }
    }
}

// Guardamos sesiones y fecha en la sesión
$_SESSION['sesiones'] = $sesiones;
$_SESSION['fecha_hoy'] = $fechaHoy;
