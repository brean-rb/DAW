<?php
    class calculo{

        private $lado;
        private $largo;
        private $ancho;

        public function __construct($lado, $largo, $ancho){
            $this->lado = $lado;
            $this->largo = $largo;
            $this->ancho = $ancho;
        }


        public function calc_perimetro(){
            $contador = 0;
            for($i = 0 ; $i <4 ; $i++){
                $contador += $this->lado;
            }

            return $contador;
        }

        public function calc_area(){
            return $this->lado *2;
        }

        public function calc_volumen(){
            return $this->largo * $this->lado * $this->ancho;
        }
    }
?>