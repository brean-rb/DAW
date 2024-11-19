<?php
include_once("modificar_ficheros/fichero.php");
class socios
{

    private $fichero;
    public function __construct()
    {
        $this->fichero = new fichero("ficheros/socios.txt");
    }

    public function verSocio($nom)
    {
        $existe = false;
        $contenido = $this->fichero->leer();
        for ($i = 0; $i < count($contenido); $i++) {
            if ($nom === $contenido[$i]) {
                $existe = true;
            }
        }
        return  $existe;
    }

    public function anadirSocio($nom)
    {
        $anadido = false;
        $existe = false;
        $contenido = $this->fichero->leer();
        for ($i=0; $i <count($contenido) ; $i++) { 
            if ($nom === $contenido[$i]) {
                $existe = true;
            }
        }
        if (!$existe) {
        $anadido = $this->fichero->nuevo($nom);
        } else{
            $anadido = false;
        }
        return $anadido;
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
