<?php
require('lineaF.php');

class factura{

   private $facturas = [];
   private $IVA = 0.21;

    // Add a new line to the factura
    public function agregarLinea($pre_ud, $cant_ud){
        $this->facturas[] = new lineaF($pre_ud, $cant_ud);
    }

    // Safely remove a specific line from factura
    public function eliminarLinea($nfact){
        if (isset($this->facturas[$nfact])) {
            unset($this->facturas[$nfact]);
        }
    }

    // Calculate total with IVA for a specific line
    public function calcularFactura($nfact){
        if (isset($this->facturas[$nfact])) {
            $total = $this->facturas[$nfact]->getPrecio() * $this->facturas[$nfact]->getCant();
            $totalcIVA = $total * (1 + $this->IVA);
            return $totalcIVA;
        }
        return 0;
    }

    // Calculate discount on the total factura
    public function calculoDesc($nfact, $desc){
        $totalIva = $this->calcularFactura($nfact);  // Pass the nfact parameter
        $totaldescuento = $totalIva * (1 - $desc);
        return $totaldescuento;
    }
}
