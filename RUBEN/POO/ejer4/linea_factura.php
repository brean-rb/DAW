<?php
    
    class linea_factura {

        private $pre_unidad, $num_unidades;


        public function __construct($pre_unidad, $num_unidades){
            $this->pre_unidad = $pre_unidad;
            $this->num_unidades = $num_unidades;
        }

        public function get_pre_unidad(){
            return $this->pre_unidad;
        }

        public function get_num_unidades(){
            return $this->num_unidades;
        }

    }
?>