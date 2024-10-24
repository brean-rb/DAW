
<?php

class Calculadora{

    private $num1;
    private $num2;
    private $oper;

    public function __construct($num1, $num2, $oper){
        $this->num1 = $num1;
        $this->num2 = $num2;
        $this->oper = $oper;
    }

    public function calculadora(){
        $result;
        switch ($this->oper) {
            case '+':
                $result = ($this->num1 + $this->num2);
                break;
            case '-':
                $result = ($this->num1 - $this->num2);
                break;
            case '*':
                $result = ($this->num1 * $this->num2);
                break;
            case '/':
                $result = ($this->num1 / $this->num2);
                break;
            case '%':
                $result = ($this->num1 % $this->num2);
                break;
            default:
                $result = null;
                break;
        }
        return $result;
    }
}