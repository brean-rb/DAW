<?php
/* Clase para calcular y registrar los tiquets de entrada en unas instalaciones deportivas
 * Hay tres tipos de clientes, normales, socios que debe indicar nombre y fecha de la cuota
 * para ver si está en vigor y los monitores, empleados de las instalaciones.
 * Hay tres ficheros con los moniores, socios y precios
 * Además cuando calcula el total, lo guarda en otro fichero para tener la recaudación del día
*/

if(!defined("REGISTRO")){ // Si no esta definida la cte hace el include para evitar repeticiones
  include("config.php");
}

class tiquet {
   private $total; // Total a pagar - tiquet
   private $precios = array(); // Lista de precios array asociativo tipo => precio
   private $dfSocios; // Fichero de socios
   private $dfMonitores; // Fichero de monitores (empleados) 
   private $dfPrecios;  // Fichero de precios
   private $dfRegistro; // Fichero de registro de cobros
   private $socios = array();  // Lista de socios
   private $monitores = array(); // Lista de monitores (empleados)
   private $hoy; // Guarda la fecha de hoy 
   private $hoyStr; // Hoy como String
   private $excepcionFicheros;

   public function __construct(){
    try{  
      $this->total = false;
      $this->excepcionFicheros = false; // Si hay error al abrir los f¡cheros
      $this->dfSocios = @fopen(SOCIOS, "r");
      if($this->dfSocios !== false){
         // Primer campo nombre el segundo codigo y tercero fecha pago cuota
         // Toma el primero como clave  y la fecha como valor
          $aux = explode(";", trim(fgets($this->dfSocios)));
          $this->socios[$aux[0]] = $aux[2];
          while(!feof($this->dfSocios)) { 
             $aux = explode(";", trim(fgets($this->dfSocios)));
             $this->socios[$aux[0]] = $aux[2];
          }  
      }
      else{
         throw new Exception("Error al abrir SOCIOS<br>");
      }
      $this->dfMonitores = @fopen(MONITORES, "r");
      if($this->dfMonitores !== false){
          $this->monitores[] = trim(fgets($this->dfMonitores));
          while(!feof($this->dfMonitores)) {
             $this->monitores[] = trim(fgets($this->dfMonitores)); 
          }  
      }
      else{
         throw new Exception("Error al abrir MONITORES<br>");
      }
      $this->dfPrecios = @fopen(PRECIOS, "r");
      if($this->dfPrecios !== false){
         // Fichero tipo de tarifa ;  precio
          $aux = explode(";", fgets($this->dfPrecios));
          $this->precios[$aux[0]] = $aux[1];
          while(!feof($this->dfPrecios)) {
            $aux = explode(";", fgets($this->dfPrecios));
            $this->precios[$aux[0]] = $aux[1];             
          }  
      }
      else{
         throw new Exception("Error al abrir PRECIOS<br>");
      }
      $this->dfRegistro = @fopen(REGISTRO, "a");
      if($this->dfRegistro === false) {
         throw new Exception("Error al abrir REGISTRO<br>");
      }
      
      $this->hoy = date_create(); //Fecha actual para gravar con los pagos
      $this->hoyStr = date_format( $this->hoy, "Y-m-d");
      // Cierra los ficheros de lectura
      fclose($this->dfMonitores);
      fclose($this->dfSocios);
      fclose($this->dfPrecios);

    }// try
    catch (Exception $e) {
      $this->excepcionFicheros = $e->getMessage();
    }
   } // __construct

   public function pago() {
      $argc = func_num_args(); // Num. argumentos
      $argv = func_get_args(); // Array argumentos
       
      //Llama a la funcion correcta segun num parametros y su nombre raiz
      if(method_exists($this, $f="pago" . $argc)) {
         $this->total = call_user_func_array(array($this, $f), $argv);
         fclose($this->dfRegistro); // Cirra registro.txt
         return $this->total;  // Devuelve el resultado del metodo llamado
      }
   } // pago()

   private function pago0(){   
      $res = (float)$this->precios["normal"] + ((float)$this->precios["normal"] * IVA);
      fputs($this->dfRegistro, $res . " -- " . $this->hoyStr . "\n");
      return $res; 
   }

   private function pago1($codigoMonitor){
      if(in_array($codigoMonitor, $this->monitores)) {
         $res = (float)$this->precios["monitor"] + ((float)$this->precios["monitor"] * IVA);
         fputs($this->dfRegistro, $res . " -- " . $this->hoyStr . "\n");
      }
      else {
         $res = false; // Codigo de monitor incorrecto
      }
      return $res; 
   }

   private function pago2($nomSocio, $fechaCuota){
      if(array_key_exists($nomSocio, $this->socios) && ($this->socios[$nomSocio] == $fechaCuota)){         
         // Resta un anyo a la fecha actual para comprobar si la fecha
         // de pago de socio está dentro del anyo natural
         $unAny = $this->hoy;
         // Resta un anyo a la fecha actual
         $unAny->sub(DateInterval::createFromDateString("1 year")); //Intervalo de 1 anyo
         $fCuota = new DateTime($fechaCuota);
         $diferencia = $fCuota->diff($unAny); //Si el periodo desde el pago < 1 anyo
         $valor = (int)$diferencia->format("%Y"); //Diferencia en anyos y lo convierte a int
         if($valor == 0){// Cuota pagada en menos 1 año
            $res = (float)$this->precios["socio"] + ((float)$this->precios["socio"] * IVA);
            fputs($this->dfRegistro, $res . " -- " . $this->hoyStr . "\n");
         }
         else {
            $res = false;
         }
      }
      else {
         $res = false;
      }
      return $res;      
   }
   
 //  public function __destruct() {

 //  } // __destruct
   public function getSocios(){
      return $this->socios;
   }
   public function getMonitores(){
      return $this->monitores;
   }  
   public function getPrecios(){
      return $this->precios;
   }
    public function getExcepcionFicheros(){
      return $this->excepcionFicheros;
   }
} // tiquet
