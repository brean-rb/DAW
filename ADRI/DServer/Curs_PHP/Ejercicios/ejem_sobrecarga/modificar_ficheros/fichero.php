<?php
/* Clase que permite modificar el contenido de un fichero. Acceso secuencial y directo.
 * El acceso se realiza de forma secuencial, lo que significa que el proceso de borrado
 * o modificación consiste en recorrer el fichero y en un fichero auxiliar se van copiando
 * todos los elementos que no son el que buscamos hasta encontrar el elemento a modificar
 * o eliminar, si es eliminar se salta este y se copia el resto del fichero, si es modificar,
 * se cambia y se graba el elemento modificado y después el resto del fichero. A continuación,
 * se borra el fichero original y se renombra el auxiliar al nombre del fichero original.
 * Modificar tiene un método de acceso directo, necesita guardar la posición del descriptor
 * de fichero antes de realizar la siguiente lectura, de forma que si es el elemento a
 * modificar podamos llevar el descriptor de fichero a la posición donde empieza el elemento
 * y podamos sobreescribirlo con el nuevo valor.
*/

class fichero {
   private $nombreFichero;

   public function __construct($nombre){
      $this->nombreFichero = $nombre;
   } // __construct

   public function leer(){
      echo $this->nombreFichero; 
      $contenido = array();
      try {
         $df = @fopen($this->nombreFichero, "r");
         if($df !== false){
            $contenido[] = trim(fgets($df));
            while(!feof($df)) {
             $contenido[] = trim(fgets($df));
            }
            fclose($df);
         }
         else {
            throw new Exception("Error al abrir el fichero " . $this->nombreFichero . "<br>");
         }
      }
      catch(Exception $e) {
         $contenido = $e->getMessage();
      }
      return($contenido);
   } // leer()

   public function eliminar($buscado) {
      try {
         $contenido = true; // Resultado de la operación  OK o valor Exception
         $encontrado = false; // Indica cuando encuentra el elemento a eliminar
         $df = @fopen($this->nombreFichero, "r");
         // Fichero auxiliar donde copiar el contenido del original
         $dfAux = @fopen($this->nombreFichero ."tmp", "w");
         if(($df !== false) && ($dfAux !== false)){
              $contenido = trim(fgets($df));
              if(strcmp($contenido, $buscado) !== 0) { // No es el buscado
                fputs($dfAux, $contenido . "\n"); // No es el buscado grava en el auxiliar
              }
              else {
               $encontrado = true; // Encontrado era el 1r
              }
              // El bucle ermina cuando encuentra el elemento o llega al final del fichero
              while(!feof($df) && ($encontrado === false)) {
                 $contenido = trim(fgets($df));
                 if(strcmp($contenido, $buscado) !== 0) { // No es el buscado
                    fputs($dfAux, $contenido . "\n"); // No es el buscado grava en el auxiliar
                 }
                 else {
                    $encontrado = true; // Ha encontrado el elemento a borrar
                 }
              } // while
              // Si lo ha encontrado se lo salta y copia el resto del fichero hasta el final
              if($encontrado === true) {
                $contenido = trim(fgets($df)); // Lee el elemento siguiente
                while(!feof($df)) {
                 fputs($dfAux, $contenido . "\n");
                 $contenido = trim(fgets($df));
                }
                $contenido = $encontrado; // Resultado si lo ha encontrado o no
                fclose($df);
                fclose($dfAux);
                // Borra el fichero original y renombra el auxiliar con el nombre del original
                $res = unlink($this->nombreFichero); // Borra original
                if ($res === true){
                   $res2 = rename($this->nombreFichero . "tmp", $this->nombreFichero);
                   if($res2 === false){
                      throw new Exception("Error al renombrar el fichero " . $this->nombreFichero . "<br>");
                   }
                }
                else{
                   throw new Exception("Error al borrar el fichero " . $this->nombreFichero . "<br>");
               }
              }
          }
          else {
             throw new Exception("Error al abrir el fichero " . $this->nombreFichero . "<br>");
         }
      }
      catch(Exception $e) {
         $contenido = $e->getMessage();
      }
       return($contenido);
   } // eliminar()

 public function modificar($buscado, $reemplazar) {
      try {
         $contenido = true; // Resultado de la operación  OK o valor Exception
         $encontrado = false; // Indica cuando encuentra el elemento a eliminar
         $df = @fopen($this->nombreFichero, "r");
         // Fichero auxiliar donde copiar el contenido del original
         $dfAux = @fopen($this->nombreFichero ."tmp", "w");
         if(($df !== false) && ($dfAux !== false)){
              $contenido = trim(fgets($df));
              if(strcmp($contenido, $buscado) !== 0) { // No es el buscado
                fputs($dfAux, $contenido . "\n"); // No es el buscado grava en el auxiliar
              }
              else{
                 fputs($dfAux, $reemplazar . "\n"); // Encontrado lo reemplaza y grava en el auxiliar
                 $encontrado = true;
              }
              // El bucle termina cuando encuentra el elemento o llega al final del fichero
              while(!feof($df) && ($encontrado === false)) {
                 $contenido = trim(fgets($df));
                 if(strcmp($contenido, $buscado) !== 0) { // No es el buscado
                    fputs($dfAux, $contenido . "\n"); // No es el buscado grava en el auxiliar
                 }
                 else {
                    $encontrado = true; // Ha encontrado el elemento
                    fputs($dfAux, $reemplazar . "\n"); // Encontrado reemplaza y grava en el auxiliar
                 }
              } // while
              // Si lo ha encontrado se lo salta y copia el resto del fichero hasta el final
              if($encontrado === true) {
                $contenido = trim(fgets($df)); // Lee el elemento siguiente
                while(!feof($df)) {
                 fputs($dfAux, $contenido . "\n");
                 $contenido = trim(fgets($df));
                }
                $contenido = $encontrado; // Resultado si lo ha encontrado o no
                fclose($df);
                fclose($dfAux);
                // Borra el fichero original y renombra el auxiliar con el nombre del original
                $res = unlink($this->nombreFichero); // Borra original
                if ($res === true){
                   $res2 = rename($this->nombreFichero . "tmp", $this->nombreFichero);
                   if($res2 === false){
                      throw new Exception("Error al renombrar el fichero " . $this->nombreFichero . "<br>");
                   }
                }
                else{
                   throw new Exception("Error al borrar el fichero " . $this->nombreFichero . "<br>");
               }
              }
          }
          else {
             throw new Exception("Error al abrir el fichero " . $this->nombreFichero . "<br>");
         }
      }
      catch(Exception $e) {
         $contenido = $e->getMessage();
      }
       return($contenido);
   } // modificar()
   
   public function nuevo($dato) { //El dato lo pone al final
      // Podemos crear una función para añadir después de un elemento,
      // sería similar a modificar, cuando encuentro el elemento de
      // referencia lo gravo después y copio el resto en el auxiliar
      $contenido = true; // Resultado de la operació  OK o valor Exception
      try{ 
         $df = @fopen($this->nombreFichero, "a");
         if($df !== false) {
           $res = fputs($df, $dato . "\n");
           if($res === false){
            throw new Exception("Error al escribir en el fichero " . $this->nombreFichero . "<br>");
           }
           fclose($df);
         }
         else{
            throw new Exception("Error al abrir el fichero " . $this->nombreFichero . "<br>");
         }  
      }
      catch(Exception $e){
         $contenido = $e->getMessage();
      }
      return($contenido);
   } //nuevo()

   public function buscar ($buscado){
      $encontrado = false; // Encontrado true o false o valor Exception
      try{ 
         $df = @fopen($this->nombreFichero, "r");
         if($df !== false) {
            $contenido = trim(fgets($df));
            if(strcmp($contenido, $buscado) === 0) { // Es el buscado
              $encontrado = true;
            }
            // El bucle ermina cuando encuentra el elemento o llega al final del fichero
            while(!feof($df) && ($encontrado === false)) {
               $contenido = trim(fgets($df));
               if(strcmp($contenido, $buscado) === 0) { // Es el buscado
                  $encontrado = true; 
               }               
            } // while
            fclose($df);
         }
         else{
            throw new Exception("Error al abrir el fichero " . $this->nombreFichero . "<br>");
         }         
      }
      catch(Exception $e){
         $encontrado = $e->getMessage();
      }
      return $encontrado;     
   } // buscar()
   
   public function modificarDirect($buscado, $reemplazar) {
      try {
         // NOTA:
         // En este ejemplo de acceso directo a ficheros, lo hacemos sobre un fichero de texto,
         // por tanto formado por línea. Esto nos plantea el problema que si el valor nuevo es
         // menor que el actual, quedará en el fichero los caracteres demás que tiene el valor
         // actual. Para solucionarlo, añadiremos blancos al final del nuevo valor hasta 
         // igualar los tamaños de las dos cadenas. Esto no supone un problema por que al leer
         // los datos de los ficheros usamos trim().
         // También debemos tener en cuenta que si el elemento a modificar es la última línea 
         // tenga el salto de línea (\n) de forma que cuando se añadan nuevos datos lo hagan
         // en nueva línea.

         $contenido = true; // Resultado de la operación  OK o valor Exception
         $encontrado = false; // Indica cuando encuentra el elemento a eliminar
         $pos = 0; // Posición actual del descriptor de fichero
         $posAnt = 0; // Posición anterior, valor de $pos antes de volver  leer del fichero 
         if(strlen($buscado) > strlen($reemplazar)) { // Rellenar de blancos igualarlos
            // Rellena hasta la longitud del valor actual, el buscado
            $reemplazar = str_pad($reemplazar, strlen($buscado)); // Por defecto rellena con blancos    
         }
         $df = @fopen($this->nombreFichero, "r+"); // Lectura y escritura
         
         if(($df !== false)){
              $valorOriginal = fgets($df); // Si es la última línea puede que no tenga \n 
              $contenido = trim($valorOriginal);
              $pos = ftell($df); // Posición de $df en el fichero
              if(strcmp($contenido, $buscado) === 0) { // Encontrado, debe reemplazarlo
                // Va a la posición antes de leer, SEEK_SET desde el principio
                // es el valor por defecto, lo ponemos para mostrar que hay otras opciones 

                fseek($df, $posAnt, SEEK_SET);
                if($valorOriginal[strlen($valorOriginal)-1] === "\n"){
                   fputs($df, $reemplazar); // Grava el nuevo valor
                }
                else{
                  fputs($df, $reemplazar . "\n"); // Grava el nuevo valor con salto de línea
                }   
                $encontrado = true;
              }
              // El bucle termina cuando encuentra el elemento o llega al final del fichero
              while(!feof($df) && ($encontrado === false)) {
                 $posAnt = $pos; // Guarda la posición antes de leer del fichero
                 $valorOriginal = fgets($df); // Si es la última línea puede que no tenga \n 
                 $contenido = trim($valorOriginal);
                 $pos = ftell($df); // Posición de $df en el fichero
                 if(strcmp($contenido, $buscado) === 0) { //Encontrado, debe reemplazarlo
                  // Va a la posición antes de leer, SEEK_SET desde el principio
                  // es el valor por defecto, lo ponemos para mostrar que hay otras opciones 
                  fseek($df, $posAnt, SEEK_SET);  
                  if($valorOriginal[strlen($valorOriginal)-1] === "\n"){
                     fputs($df, $reemplazar); // Grava el nuevo valor
                  }
                  else{
                    fputs($df, $reemplazar . "\n"); // Grava el nuevo valor con salto de línea
                  }   
                  $encontrado = true;
                 } 
              } // while
              $contenido = $encontrado; // Resultado si lo ha encontrado o no
              fclose($df);
          }
          else {
             throw new Exception("Error al abrir el fichero " . $this->nombreFichero . "<br>");
          }
      }
      catch(Exception $e) {
         $contenido = $e->getMessage();
      }
       return($contenido);
   } // modificarDirect()
} // fichero
