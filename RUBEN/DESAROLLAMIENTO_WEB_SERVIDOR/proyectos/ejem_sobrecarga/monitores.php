<?php
    class monitores {
        private $name_monitor;
        private $option;
        private $name_fich = "ficheros/monitor.txt";

        public function __construct($name_monitor, $option){
            $this->name_monitor = $name_monitor;
            $this->option = $option;
        }

        public function select_optio(){
            if($this->option === 1){
                $this->delete_monitor();
            } else if ($this->option === 2){
                $this->add_monitor();
            } else if ($this->option === 3){
                $this->see_monitor();
            } else {
                echo "error de selecion en empleado";
            }
        }

        private function delete_monitor(){
            try{
                $contenido = true;
                $encontrado = false;

                $fich_original = @fopen($this->name_fich, "r");
                $fich_aux = @fopen($this->name_fich . "tmp", "w");

                if(($fich_original !== false) && ($fich_aux !== false)){
                    $contenido = trim(fgets($fich_original));
                    
                    if(strcmp($contenido, $this->name_monitor) !==0){
                        fputs($fich_aux, $contenido . "\n");
                    } else{
                        $encontrado = true;
                    }

                    while (!feof($fich_original) && ($encontrado === false)) {
                        $contenido = trim(fgets($fich_original));
                    
                        if(strcmp($contenido, $this->name_monitor) !==0){
                            fputs($fich_aux, $contenido . "\n");
                        } else{
                            $encontrado = true;
                        }
    
                    }
                }

            } catch(Exception $e){
                $contenido = $e->getMessage();
            }
        }

        //crar la funcion de dentro de while para no repetir codigo

        private function read_delete_fich(){
            $content = trim(fgets($fich_original));
                    
            if(strcmp($contenido, $this->name_monitor) !==0){
                fputs($fich_aux, $content . "\n");
            } else{
                return true;
            }
        }

        private function add_monitor(){

        }

        private function see_monitor(){

        }
    }
?>