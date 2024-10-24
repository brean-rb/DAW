<?php

class validarfecha{
    private $dia;
    private $mes;
    private $ano;

    public function __construct($d,$m,$a){
        $this->dia=$d;
        $this->mes=$m;
        $this->ano=$a;
    }
    public function getVar(){
        echo $this->dia . " " .  $this-> mes . " " . $this->ano;
    }
    public function comprobacion(){
        if ($this->ano == "2023") {
             $this->comprobarmes();
        }else{
            return "Error";
        }
    }
    public function comprobarmes(){
        if ($this->mes <= 12 && $this->mes >=1) {
            $this->comprobardia();
        }else{
            return "Error";
        }
    }

    public function comprobardia(){
        switch ($this->mes) {
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                if ($this->dia <= 31 && $this->dia >=1) {
                    echo "Fecha correcta";
                }else{
                    echo "Fecha invalida";
                }
                break;
            case 4:
            case 6:
            case 9:
            case 11:
                if ($this->dia <= 30 && $this->dia >=1) {
                    echo "Fecha correcta";
                }else{
                    echo "Fecha invalida";
                }
                break;
            case 2:
                if ($this->dia <= 28 && $this->dia >=1) {
                    echo "Fecha correcta";
                }else{
                    echo "Fecha invalida";
                }
                break;
            default:
                echo "Fecha invalida";
                break;
        }        

    }
}