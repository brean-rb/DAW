<?php

class CalculoEC{

    private $a,$b,$c,$respos,$resneg;

    public function __construct($numa,$numb,$numc){
        $this->a=$numa;
        $this->b=$numb;
        $this->c=$numc;
        $this->respos=0;
        $this->resneg=0;
    }

    public function setA($numa){
        $this->a=$numa;
    }
    public function getA(){
        return $this->a;
    }
    public function setB($numb){
        $this->b=$numb;
    }  
    public function getB(){
        return $this->b;
    }
    public function setC($numc){
        $this->c=$numc;
    }  
    public function getC(){
        return $this->c;
    }
    
    public function esSegGrado(){
        if ($this->a !== 0) {
            echo "Es una ecuacion de segundo grado<br>";
            $this->esReal();
        }else{
            echo "No es una ecuacion de segundo grado<br>";
        }
    }

    public function esReal(){
        $calc = (($this->b * $this->b)- (4*$this->a*$this->c));
        if($calc >= 0){
            echo "No es un numero complejo<br>";
            $this->calculo();
        }else{
            echo "Es un numero complejo<br>";
        }
    }

    public function calculo(){
        $calc = (($this->b * $this->b)- (4*$this->a*$this->c));
        if ($calc >= 0) {  
            $raiz = sqrt($calc);
            $this->respos = ((-$this->b) + $raiz) / (2 * $this->a);
            $this->resneg = ((-$this->b) - $raiz) / (2 * $this->a);
        }

    }

    public function getResultados(&$resultpos, &$resultneg){
        $resultpos = $this->respos;
        $resultneg = $this->resneg;
    }

    public function equivalentes(CalculoEC $eq2){
       if (($this->a / $eq2->getA() == $this->b / $eq2->getB()) && 
            ($this->b / $eq2->getB() == $this->c / $eq2->getC())) {
            echo "Son ecuaciones equivalentes<br>";
        } else {
            echo "No son ecuaciones equivalentes<br>";
        }
    }
}