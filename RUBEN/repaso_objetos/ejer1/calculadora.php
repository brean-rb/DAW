<?php

    class calculadora {
        private $num1;
        private $num2;
        private $ope;


        public function __construct($num1, $num2, $ope){
            $this->num1 = $num1;
            $this->num2 = $num2;
            $this->ope = $ope;
        }

        public function calculos(){
            switch ($this->ope) {
                case '+':
                    return $this->num1 . " + " . $this->num2 . " = " . ($this->num1 + $this->num2);
                    break;
                
                case '-':
                    return $this->num1 . " - " . $this->num2 . " = " . ($this->num1 - $this->num2);
                    break;
            
                case '*':
                    return $this->num1 . " * " . $this->num2 . " = " . ($this->num1 * $this->num2);
                    break;

                case '/':
                    return $this->num1 . " 7 " . $this->num2 . " = " . ($this->num1 / $this->num2);
                    break;
                
                default:
                    return "escribe un puto numero valido subnormal";
                    break;
            }
        }
    }

?>