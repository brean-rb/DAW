<?php
    class monitores {
        private $name_monitor;
        private $option;
        private $name_fich = "ficheros/monitor.txt";

        public function __construct($name_monitor){
            $this->name_monitor = $name_monitor;
        }

        public function select_option($op){
            if($op == 1){
                return $this->delete_monitor();
            } else if ($op == 2){
                return $this->add_monitor();
            } else if ($op == 3){
                return $this->see_monitor();
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
                    
                    $encontrado = $this->write_delete_fich($contenido, $fich_aux);

                    while (!feof($fich_original) && ($encontrado === false)) {

                        $encontrado = $this->write_delete_fich($contenido, $fich_aux);
    
                    }

                    if($encontrado === true){

                        $contenido = trim(fgets($fich_original));

                        while(!feof($fich_original)){

                            fputs($fich_aux, $contenido . "\n");
                            $contenido = trim(fgets($fich_original));

                        }

                        $contenido = $encontrado;

                        fclose($fich_original); //cerramos el fichero original
                        fclose($fich_aux); //cerramos el fichero auxiliar

                        $supr_fich = unlink($this->name_fich); //borrar fichero original

                        if($supr_fich === true){

                            $change_fich = rename($this->name_fich . "tmp", $this->name_fich); //renombramos el fichero auxiliar como el original

                            if($change_fich === false){
                                throw new Exception("Error al renombrar el fichero " . $this->name_fich . "<br>");
                            }

                        } else {
                            throw new Exception("Error al borrar el fichero " . $this->name_fich . "<br>");
                        }
                    }
                } else {
                    throw new Exception("Error al abrir el fichero " . $this->name_fich . "<br>");
                }

            } catch(Exception $e){
                $contenido = $e->getMessage();
            }

            return $contenido;
        } // delete_monitor()


        private function add_monitor(){
            $contenido = true;

            try {
                $file = @fopen($this->name_fich, "a");

                if($file !== false){

                    $add_monitor = fputs($file, $this->name_monitor . "\n");

                    if($add_monitor === false){
                        throw new Exception("Error al escribir en el fichero " . $this->name_fich . "<br>");
                    }

                    fclose($file);

                } else {
                    throw new Exception("Error al abrir el fichero " . $this->name_fich. "<br>");
                }

            } catch (Exception $e) {
                $contenido = $e->getMessage();
            }

            return($contenido);
        } //add_monitor();

        private function see_monitor(){
            $encontrado = false;

            try {
                $file = @fopen($this->name_fich, "r");

                if($file !== false){

                    $encontrado = $this->read_see_monitor($file);

                    while(!feof($file) && ($encontrado === false)){
                        $encontrado = $this->read_see_monitor($file);
                    }

                    fclose($file);

                } else {
                    throw new Exception ("Error al abrir el fichero " . $this->name_fich . "<br>");
                }

            } catch (\Throwable $th) {
                $encontrado = $e->getMessage();
            }

            return $encontrado;
        }

        private function write_delete_fich($content, $fx){

            $content = trim(fgets($fich_original));
                    
            if(strcmp($content, $this->name_monitor) !==0){

                fputs($fx, $content . "\n");

            } else{
                return true;
            }
        }

        private function read_see_monitor($fx){
            $contenido = trim(fgets($fx));

            if(strcmp($contenido, $this->name_monitor) === 0){
                return true;
            }
        }
    }
?>