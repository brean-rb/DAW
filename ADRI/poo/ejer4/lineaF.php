<?php
class lineaF {
  
    private $pre_unidad;
    private $cant_unidad;

    public function __construct($precio, $cantidad) {
        $this->pre_unidad = $precio;
        $this->cant_unidad = $cantidad;
    }

    public function setPrecio($precio) {
        $this->pre_unidad = $precio;
    }

    public function getPrecio() {
        return $this->pre_unidad;
    }

    public function setCantidad($cantidad) {
        $this->cant_unidad = $cantidad;
    }

    public function getCant() {  // Keep method name consistent with factura class
        return $this->cant_unidad;
    }
}
