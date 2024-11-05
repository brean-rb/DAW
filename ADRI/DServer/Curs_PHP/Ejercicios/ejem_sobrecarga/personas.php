<?php
include_once("tiquet.php");
include_once("monitores.php");
include_once("socios.php");

$cant = 0;
$pagar = new tiquet();

if ($pagar->getExcepcionFicheros() !== false) {
    echo $pagar->getExcepcionFicheros() . "<br>";
} else {
    if (isset($_POST["pagar"])) {
        if (!empty($_POST["nombresocio"]) && !empty($_POST["fechacuota"])) {
            $cant = $pagar->pago(trim($_POST["nombresocio"]), $_POST["fechacuota"]);
        } else {
            if (!empty($_POST["codigomonitor"])) {
                $cant = $pagar->pago(trim($_POST["codigomonitor"]));
            } else {
                if ($cant === 0) {
                    $cant = $pagar->pago();
                }
            }
        }
        if ($cant !== false) {
            echo "El pago realizado es de: " . $cant . "<br>";
        } else {
            echo "Error en el pago<br>";
        }
    } // pagar
} // ExcepcionFicheros



// Inicio modificaciones Adri
if (isset($_POST["sociomonitor"])) {
    if ($_POST["sociomonitor"] === "Monitor") {
        if (isset($_POST["ver"])) {
            if (!empty($_POST["codigomonitor"])) {
                $monitor1 = new monitores();
                $nombre = trim($_POST["codigomonitor"]);
                $contenido = $monitor1->verMonitor($nombre);
                if ($contenido) {
                    echo "El monitor " . $nombre . " existe en la base de datos";
                } else {
                    echo "El monitor " . $nombre . " no está registrado";
                }
            } else {
                echo "Defina un código de monitor";
            }
        }

        if (isset($_POST["anadir"])) {
            if (!empty($_POST["codigomonitor"])) {
                $monitor2 = new monitores();
                $monitoranadir = trim($_POST["codigomonitor"]);
                $contenido = $monitor2->verMonitor($monitoranadir);
                if ($contenido) {
                    echo "El monitor " . $monitoranadir . " ya existe en la base de datos <br>";
                } else {
                    $anadido = $monitor2->anadirMonitor($monitoranadir);
                    echo "El monitor " . $monitoranadir . " no está registrado, se añadirá a la base de datos <br>";
                }
            } else {
                echo "Defina un código de monitor";
            }
        }

        if (isset($_POST["eliminar"])) {
            if (!empty($_POST["codigomonitor"])) {
                $monitor3 = new monitores();
                $monitorel = trim($_POST["codigomonitor"]);
                $borrado = $monitor3->eliminarMonitor($monitorel);
                if ($borrado) {
                    echo "El monitor " . $monitorel . " se ha borrado con éxito";
                } else {
                    echo "Error al borrar";
                }
            } else {
                echo "Defina un código de monitor";
            }
        }
    } else if ($_POST["sociomonitor"] === "Socio") {
        if (isset($_POST["ver"])) {
            if ((isset($_POST["nombresocio"]) && !empty($_POST["nombresocio"])) &&
                (isset($_POST["fechacuota"]) && !empty($_POST["fechacuota"])) &&
                (isset($_POST["codigomonitor"]) && !empty($_POST["codigomonitor"]))
            ) {
                $socio1 = new socios();
                $nombre =  $_POST["nombresocio"] . ";" . $_POST["codigomonitor"] . ";" . $_POST["fechacuota"];
                $contenido = $socio1->verSocio($nombre);
                if ($contenido) {
                    echo "El socio " . $_POST["nombresocio"] . " con codigo:" . $_POST["codigomonitor"] .   " existe en la base de datos";
                } else {
                    echo "El socio " . $_POST["nombresocio"] . " con codigo:" . $_POST["codigomonitor"] .   " no existe en la base de datos";
                }
            } else {
                echo "Por favor, complete todos los campos.";
            }
        }
        if (isset($_POST["anadir"])) {
            if ((isset($_POST["nombresocio"]) && !empty($_POST["nombresocio"])) &&
                (isset($_POST["fechacuota"]) && !empty($_POST["fechacuota"])) &&
                (isset($_POST["codigomonitor"]) && !empty($_POST["codigomonitor"]))
            ) {
                $socio1 = new socios();
                $nombre =  $_POST["nombresocio"] . ";" . $_POST["codigomonitor"] . ";" . $_POST["fechacuota"];
                $anadido = $socio1->anadirSocio($nombre);
                if (!$anadido) {
                    echo "El socio " . $_POST["nombresocio"] . " con codigo:" . $_POST["codigomonitor"] .   " existe en la base de datos";
                } else {
                    echo "El socio " . $_POST["nombresocio"] . " con codigo:" . $_POST["codigomonitor"] .   " no existe en la base de datos, por lo tanto se añadirá a continuación";
                }
            } else {
                echo "Por favor, complete todos los campos.";
            }
        }
        if (isset($_POST["eliminar"])) {
            if ((isset($_POST["nombresocio"]) && !empty($_POST["nombresocio"])) &&
                (isset($_POST["fechacuota"]) && !empty($_POST["fechacuota"])) &&
                (isset($_POST["codigomonitor"]) && !empty($_POST["codigomonitor"]))
            ) {
                $socio1 = new socios();
                $nombre =  $_POST["nombresocio"] . ";" . $_POST["codigomonitor"] . ";" . $_POST["fechacuota"];
                $borrado = $socio1->eliminarSocio($nombre);
                if ($borrado) {
                    echo "El socio " . $_POST["nombresocio"] . " con codigo:" . $_POST["codigomonitor"] .   " ha sido eliminado de la base de datos";
                } else {
                    echo "Error al borrar el socio " . $_POST["nombresocio"] . " con codigo:" . $_POST["codigomonitor"];
                }
            } else {
                echo "Defina un código de monitor";
            }
        }
    } else {
        echo "Elija un tipo de miembro";
    }
}
