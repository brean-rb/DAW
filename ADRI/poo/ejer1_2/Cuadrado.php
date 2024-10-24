<?php
class Cuadrado {
    private $lado;

    // Constructor
    public function __construct($lado) {
        $this->lado = $lado;
    }

    // Método para obtener el perímetro del cuadrado
    public function getPerimetro() {
        return 4 * $this->lado;
    }

    // Método para obtener el área del cuadrado
    public function getArea() {
        return $this->lado * $this->lado;
    }

    // Método para obtener el volumen de un cubo basado en el cuadrado
    public function getVolumen() {
        return pow($this->lado, 3);
    }

    // Método para obtener el valor del lado
    public function getLado() {
        return $this->lado;
    }
}
?>
 