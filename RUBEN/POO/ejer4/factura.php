<?php
    define('IVA', 0.21);
    include('linea_factura.php');

    class factura{

        private $facturas = [];

        public function add_line_fact($precio, $unidades){
            $this->facturas[] = new linea_factura($precio, $unidades);
        }

        public function delete_line_fact($index){
            $this->facturas[$index] = null;
        }

        public function calc_fact($index){
            if (isset($this->facturas[$index])) { // Verifica si la factura existe
                $total = $this->facturas[$index]->get_pre_unidad() * $this->facturas[$index]->get_num_unidades();
                $total_iva = $total * (1 + IVA); // Aplicar IVA
                return $total_iva;
            } else {
                return "Factura no encontrada.";
            }
        }

        public function desc_calc_fact($index, $descuento) {
            $total_iva = $this->calc_fact($index); // Calcular el total de esa factura
            if (is_numeric($total_iva)) { // Verifica que no haya un error (como "Factura no encontrada")
                return $total_iva * (1 - $descuento / 100); // Aplicar el descuento en porcentaje
            } else {
                return $total_iva; // Retorna el mensaje de error si no hay factura
            }
        }
    }
?>