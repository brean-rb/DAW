<?php
include("Cuadrado.php");

class Deposito extends Cuadrado{

    private $material;
    private $precio;

    public function __construct($lado, $material, $precio) {
        parent::__construct($lado);
        $this->material = $material;
        $this->precio = $precio;
    }

    // Métodos para el material
    public function setMaterial($mat) {
        $this->material = $mat;
    }

    public function getMaterial() {
        return $this->material;
    }

    public function setPrecio($pre) {
        $this->precio = $pre;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getPerimetro() {
        return $this->cuadrado->getPerimetro();
    }

    public function getArea() {
        return $this->cuadrado->getArea();
    }

    public function getVolumen() {
        return $this->cuadrado->getVolumen();
    }
    public function esIgual(Deposito $deposito2) {
        $esIgual;
            if (($this->material === $deposito2->getMaterial()) &&
               ($this->precio === $deposito2->getPrecio())){
                echo "Son el mismo deposito!";
            }
               else{
                echo "Los depositos son diferentes";
               }
    }

    public function masCaro(Deposito $deposito2) {
        if (($this->precio) > ($deposito2->getPrecio())) {
            echo "<br> Es mas caro el deposito 1";
        }else if(($this->precio)===($deposito2->getPrecio())){
            echo "<br> Los depositos tienen el mismo precio";
        }else{
            echo "<br> Es mas caro el deposito 2";
            
        }
    }
}
?>
