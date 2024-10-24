<?php
    include("guia.php");
    class abonado {
        private $surname1, $surname2, $name, $phone, $address;
        
        public function __construct($surname1, $surname2, $name, $phone, $address){
            $this->surname1 = $surname1;
            $this->surname2 = $surname2;
            $this->name = $name;
            $this->phone = $phone;
            $this->address = $address;
        }
    }
?>