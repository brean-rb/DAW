<?php
    class fecha{
        private $dia, $mes, $ano;

        public function __construct($dia, $mes, $ano){
            $this->dia = $dia;
            $this->mes = $mes;
            $this->ano = $ano;
        }

        private function comprovate_year(){
            if($this->ano == 2023){
                $this->comprovate_month();
            } 
        }

        private function comprovate_month(){
            if($this->mes >= 1 && $this->mes <=12){
                $this->comprovate_year();
            }
        }

        private function comprovate_day(){
            if($this->mes ==2 && $this->dia >= 1 && $this->dia <=28){
                return true;
            } else {
                switch ($this->mes) {
                    case 1:
                    case 3:
                    case 5:
                    case 7:
                    case 8:
                    case 10:
                    case 12:
                        
                        if (($this->dia >= 1) && ($this->dia <= 31)) {
                            return true;
                        }
                        break;
                    case 4:
                    case 6:
                    case 9:
                    case 11:
                        if (($this->dia >= 1) && ($this->dia <= 30)) {
                            return true;
                        }
                        break;
                    default:
                        return false;
                        break;
                }
            }
        }

        public function __toString(){
            if($this->comprovate_day()){
                return "fecha valida";
            } else {
                return "fecha no valida";
            }
        }
    }
?>