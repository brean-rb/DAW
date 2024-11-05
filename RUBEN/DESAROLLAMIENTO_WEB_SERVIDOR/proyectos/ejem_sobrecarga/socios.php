<?php

    class socios {
        //atributos
        private $name_partner;
        private $date;
        private $date_str;
        private $option;
        private $name_file = "ficheros/socios.txt";

        public function __construct($name_partner, $date = null){
            $this->name_partner = $name_partner;
            
            if($date !== null){
                $this->date = $date;
                $this->date_str = date("Y-m-d", strtotime($this->date));
            }
        }

        public function select_option($op){
            try {
                if($op === 1){
                    return $this->delete_partner();
                } else if ($op === 2){
                    return $this->add_partner();
                } else if ($op === 3){
                    return $this->see_partner();
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

                        $find = $this->write_delete_file($file_original, $file_aux);

                    }

                    if($find === true){

                        $content = trim(fgets($file_original));

                        while(!feof($file_original)){

                            fputs($file_aux, $content . "\n");
                            $content = trim(fgets($file_original));

                        }

                        $content = $find;

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
                $content = $e->getMessage();
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

        private function see_partner(){
            $find = false;

            try {
                
                $file = @fopen($this->name_file, "r");

                if($file !== false){

                    while((!feof($file)) && ($find === false)){
                        $find = $this->read_see_partner($file);
                    }

                    fclose($file);

                } else {
                    throw new Exception ("Error al abrir el fichero " . $this->name_file . "<br>");
                }

            } catch (Exception $e) {
                $find = $e->getMessage();
            }

            return $find;
        }

        private function generate_cod_partner() {
            $numeros = '';
            for ($i = 0; $i < 5; $i++) {
                $numeros .= rand(0, 9); 
            }
            return $numeros;
        }

        private function write_delete_file($fo, $fx){
            $c = trim(fgets($fo));

            // Verificamos si la línea no está vacía
            if (!empty($c)) {
                // Dividimos la línea por el punto y coma
                $fields = explode(';', $c);
        
                // Extraemos el nombre del socio (primer campo)
                $nombre_socio_linea = $fields[0];
        
                // Comparamos el nombre extraído con el nombre del socio a eliminar
                if(strcmp($nombre_socio_linea, $this->name_partner) !== 0){
                    fputs($fx, $c . "\n");
                    return false;
                } else {
                    return true; // Encontramos al socio y no lo escribimos en el archivo temporal
                }
            } else {
                // Si la línea está vacía, continuamos sin hacer nada
                return false;
            }
        }

        private function read_see_partner($fx){
            $c = trim(fgets($fx));

            if (!empty($c)) {
                
                $fields = explode(';', $c);

                $nombre_socio_linea = $fields[0];

                if(strcmp($nombre_socio_linea, $this->name_partner) === 0){
                    return true;
                } else {
                    return false;
                }

            } else{
                return false;
            }
        }
    }

?>