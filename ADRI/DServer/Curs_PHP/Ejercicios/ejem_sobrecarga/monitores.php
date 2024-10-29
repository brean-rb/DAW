<?php
include("modificar_ficheros/fichero.php");
class monitores{

    private $nombre;
    private $fichmonitor = "ficheros/monitores.txt";
    private $fichero;
    public function __construct($nom){
        $this->nombre=$nom;
        $this->fichero = new fichero($this->fichmonitor);
    }

    public function verMonitor(){
        echo $this->nombre;
        $contenido = $this->fichero->leer();
        for ($i=0; $i <count($contenido) ; $i++) { 
            echo $contenido;
        }
    }
}