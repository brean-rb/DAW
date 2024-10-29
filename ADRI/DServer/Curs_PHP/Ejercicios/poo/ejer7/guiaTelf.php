<?php

class guiaTelf{

    private $name;
    private $cname;
    private $telf;
    private $addrs;

    private $guia = [];
    
    public function __construct($name, $cname, $telf, $addrs){
        $this->name=$name;
        $this->cname=$cname;
        $this->telf=$telf;
        $this->addrs=$addrs;
        
    }

    public function crearLinea(){

    }
}