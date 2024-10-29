<?php
include("modificar_ficheros/fichero.php");
class monitores{

    private $fichero;
    public function __construct(){
        $this->fichero = new fichero("ficheros/monitor.txt");
    }

    public function verMonitor($nom){
        $existe = false;
        $contenido = $this->fichero->leer();
        for ($i=0; $i <count($contenido) ; $i++) { 
           if ($nom === $contenido[$i]) {
            $existe = true;
           }
        }
        return  $existe;
    }
}