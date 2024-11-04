<?php
include("modificar_ficheros/fichero.php");
class socios{

    private $fichero;
    public function __construct(){
        $this->fichero = new fichero("modificar_ficheros/ficheros/socios.txt");
    }

    public function verSocio($nom){
       
    }

    public function anadirSocio($nom){
        $grabado = $this->fichero->nuevo($nom);
        $dev = false;
        if ($grabado) {
            $contenido = $this->fichero->leer();
            for ($i=0; $i <count($contenido) ; $i++) { 
                if ($nom === $contenido[$i]) {
                    $dev = true;
                }
            } 
        }
        if ($dev) {return $contenido;}
    }

    public function eliminarSocio($nom){
        $eliminado =$this->fichero->eliminar($nom);
        $borrado = false;
        if ($eliminado) {
            $borrado = true;
        }
        return $borrado;
    }
}