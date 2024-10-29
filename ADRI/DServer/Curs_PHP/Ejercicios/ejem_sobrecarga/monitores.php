<?php

class monitores{

    private $nombre;

    public function __construct($nom){
        $this->nombre=$nom;
    }

    public function verMonitor(){
        echo $this->nombre;
    }
}