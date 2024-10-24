<?php
    include("cuadrado.php");

    class deposito extends calculo {
        private $material;
        private $precio;
    
        public function __construct($lado, $largo, $ancho, $material, $precio){
            parent::__construct($lado, $largo, $ancho);
            $this->material = $material;
            $this->precio = $precio;
        }

        public function set_material(){
            return $this->material;
        }

        public function set_precio(){
            return $this->precio;
        }

        public function son_iguales($mat1, $mat2, $pre1, $pre2){
            $resultado = "<br><br>";
            if(($mat1 == $mat2) && ($pre1 == $pre2)){
                $resultado .= "son iguales los dos depositos";
            } else{
                $resultado .= "los dos depositos son diferentes";
            }

            $resultado.= $this->mas_caro($pre1, $pre2);

            return $resultado;
        }

        private function mas_caro($pre1, $pre2){
            if($pre1 > $pre2){
                return "<br>el deposito uno es mas caro que el 2";
            } else if ($pre1 < $pre2){
                return "<br>el depsito 2 es mas caro que el 1";
            } else{
                return "<br>lo dos depsitos son iguales";
            }
        }
    }

?>