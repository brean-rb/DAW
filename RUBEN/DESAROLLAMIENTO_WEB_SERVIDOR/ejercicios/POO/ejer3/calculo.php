<?php
    class calculo {
        private $a, $b, $c, $resultado1, $resultado2;

        public function __construct($a, $b, $c){
            $this->a = $a;
            $this->b = $b;
            $this->c = $c;
        }

        public function get_a(){
            return $this->a;
        }

        public function get_b(){
            return $this->b;
        }

        public function get_c(){
            return $this->c;
        }

        public function es_segundo_grado(){
            if ($this->a != 0){
                return true;
            } else{
                echo "No es una ecuación de segundo grado";
                return false;
            }
        }

        private function es_real(){
            $calc1 = ($this->b * $this->b) - (4 * $this->a * $this->c);

            if($calc1 >= 0){
                return true;
            } else{
                echo "El resultado es imaginario porque el discriminante es negativo";
                return false;
            }
        }

        public function calc(){
            if ($this->es_segundo_grado() && $this->es_real()) {
                $calc2 = sqrt(($this->b * $this->b) - (4 * $this->a * $this->c));

                $this->resultado1 = (-$this->b + $calc2) / (2 * $this->a);
                $this->resultado2 = (-$this->b - $calc2) / (2 * $this->a);

                echo "Las soluciones son: " . $this->resultado1 . " y <br>" .  $this->resultado2 ." <br>";
            }
        }

        public function es_equivalente(calculo $object2){
            $ratio_a = $this->a / $object2->get_a();
            $ratio_b = $this->b / $object2->get_b();
            $ratio_c = $this->c / $object2->get_c();

            if ($ratio_a == $ratio_b && $ratio_b == $ratio_c) {
                echo "Las ecuaciones son equivalentes";
            } else {
                echo "Las ecuaciones no son equivalentes";
            }
        }
    }
?>
