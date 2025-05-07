<?php
/**
 * Configuración de conexión a la base de datos MySQL.
 *
 * @package    GestionGuardias
 * @author     Adrian  
 * @license    MIT
 */
DEFINE("SERVIDOR",   "localhost");  // Dirección del servidor MySQL
DEFINE("USER",       "root");       // Usuario de la base de datos
DEFINE("PASSWD",     "");           // Contraseña del usuario
DEFINE("BASE_DATOS", "guardias");   // Nombre de la base de datos

/**
 * Ejecuta una consulta SQL sobre la base de datos MySQL.
 *
 * - Maneja la conexión, la ejecución de la consulta y el cierre de la misma.
 * - Registra errores de conexión o de consulta en el log de errores.
 * - Para SELECT devuelve un array de filas (numérico).
 * - Para INSERT/UPDATE/DELETE devuelve true si afectó al menos una fila.
 *
 * @param string $serv  Servidor MySQL.
 * @param string $user  Usuario MySQL.
 * @param string $passwd Contraseña MySQL.
 * @param string $bd    Nombre de la base de datos.
 * @param string $sql   Cadena SQL a ejecutar.
 *
 * @return array|bool   - En SELECT: array de filas (MYSQLI_NUM), vacío si no hay resultados.  
 *                      - En INSERT/UPDATE/DELETE: true si hubo filas afectadas, false en caso contrario.  
 *                      - false en caso de error de conexión o consulta.
 */
function conexion_bd($serv, $user, $passwd, $bd, $sql) {
    // Intentar conectar al servidor MySQL
    $con_bd = @mysqli_connect($serv, $user, $passwd, $bd);
    if (!$con_bd) {
        // Loguea error de conexión
        error_log("Error al conectar: " . mysqli_connect_error());
        return false;
    }
    // Asegurarse de que los datos se manejan en UTF-8
    $con_bd->set_charset('utf8');

    // Ejecutar la consulta
    $res = mysqli_query($con_bd, $sql);
    if ($res === false) {
        // Si hay error en la consulta, lo registra en 'errores.log'
        error_log(
            "MySQL error en [{$sql}]: " .
            mysqli_error($con_bd) .
            "\n",
            3,
            "errores.log"
        );
        mysqli_close($con_bd);
        return false;
    }

    // Determinar el tipo de operación (SELECT, INSERT, UPDATE, DELETE, etc.)
    $operacion = strtoupper(strtok($sql, " "));
    switch ($operacion) {
        case "SELECT":
            // Para SELECT: devolver todas las filas en un array numérico
            if (mysqli_num_rows($res) >= 1) {
                $res_array = mysqli_fetch_all($res, MYSQLI_NUM);
            } else {
                $res_array = []; // No hay filas
            }
            break;

        case "INSERT":
        case "UPDATE":
        case "DELETE":
            // Para modificaciones: true si afectó al menos una fila
            $res_array = (mysqli_affected_rows($con_bd) > 0);
            break;

        default:
            // Otros tipos de consultas no soportados
            $res_array = false;
    }

    // Cerrar la conexión
    mysqli_close($con_bd);
    return $res_array;
}
