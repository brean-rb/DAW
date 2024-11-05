<?php

    class socios {
        //atributos
        private $name_partner;
        private $date;
        private $date_str;
        private $option;
        private $name_file = "ficheros/socios.txt";

        public function __construct($name_partner){
            $this->name_partner = $name_partner;
            $this->date = $date_create();
            $this->date_str = date("Y-m-d", strtotime($this->date));
        }

        public function select_option($op){
            try {
                if($op === 1){
                    return $this->delete_partner();
                } else if ($op === 2){
                    return $this->add_partner();
                } else if ($op === 3){
    
                } else {
                    throw new Exception("error de selecion en empleado");
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        }

        private function delete_partner(){
            try{
                $content = true;
                $find = false;

                $file_original = @fopen($this->name_file, "r");
                $file_aux = @fopen($this->name_file . "tmp", "w");

                if(($file_original !== false) && ($file_aux !== false)){
                    
                    while (!feof($file_original) && ($find === false)){
                        $find = $this->write_delete_file($content, $file_original, $file_aux);
                    }

                    if($find === true){

                        $content = trim(fgets($file_original));

                        while(!feof($file_original)){

                            fputs($file_aux, $content . "\n");
                            $content = trim(fgets($file_original));

                        }

                        $content = $file;

                        fclose($file_original);
                        fclose($file_aux);

                        $supr_file = unlink($this->name_file);

                        if($supr_file === true){
                            
                            $change_file = rename($this->name_file . "tmp", $this->name_file);

                            if($change_file === false){
                                throw new Exception("Error al renombrar el fichero " . $this->name_file . "<br>"); 
                            }

                        } else {
                            throw new Exception("Error al borrar el fichero " . $this->name_file . "<br>");
                        }
                    }
                } else {
                    throw new Exception("Error al abrir el fichero " . $this->name_file . "<br>");
                }

            } catch (Exception $e){
                $content = $e-getMessage();
            }

            return $content;
        }

        private function add_partner(){
            $content = true;

            try{

                $file = @fopen($this->name_file, "a");

                if($file !== false){

                    $add_partner = fputs($file, $this->name_partner . ";". $this->generate_cod_partner() . ";". $this->date_str . "\n");

                    if($add_partner === false){
                        throw new Exception("Error al escribir en el fichero " . $this->name_file . "<br>");
                    }
                    fclose($file);

                } else{
                    throw new Exception("Error al abrir el fichero " . $this->name_file. "<br>");
                }

            } catch(Exception $e){
                $content = $e->getMessage();
            }


            return $content;
        }

        private function generate_cod_partner() {
            $numeros = '';
            for ($i = 0; $i < 5; $i++) {
                $numeros .= rand(0, 9); 
            }
            return $numeros;
        }

        private function write_delete_file($c, $fo, $fx){
            $c = trim(fgets($fx));

            if(strcmp($c, $this->name_partner) === 0){
                return true;
            } else{
                return false;
            }
        }
    }

?>