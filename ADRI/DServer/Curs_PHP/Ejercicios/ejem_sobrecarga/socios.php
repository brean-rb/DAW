<?php
include("modificar_ficheros/fichero.php");

class socios
{
    private $fichero;
    public function __construct() {
        $this->fichero = new fichero("modificar_ficheros/ficheros/socios.txt");
    }

    public function verSocio($nombreSocio) {
        $contenido = $this->fichero->leer();
        return strpos($contenido, $nombreSocio) !== false;
    }
}
