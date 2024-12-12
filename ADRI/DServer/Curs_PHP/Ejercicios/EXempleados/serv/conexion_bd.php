<?php

define("SERV","localhost");
define("USER","root");
define("PASSW","");
define("DBASE","empresa");

function conexion($sql)
{
    $conex = @mysqli_connect(SERV,USER,PASSW,DBASE);
    if($conex){
        if ($res = mysqli_query($conex,$sql)) {
            $consulta = explode(' ',$sql);
        
            switch($consulta[0]){
                case "SELECT":
                    if (mysqli_num_rows($res)>=1) {
                        $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
                    } else{
                        $result = "Error al encontrar los datos en la BD";
                    }
                    break;
                case "INSERT":
                case "UPDATE":
                case "DELETE":
                    if (mysqli_affected_rows($res) > 0) {
                        if ($consulta[0] == "INSERT") {
                            $result = "Empleado dado de alta satisfactoriamente";
                        } else if($consulta[0] == "UPDATE"){
                            $result = "Datos del empleado modificados correctamente";
                        } else if($consulta[0] == "DELETE"){
                            $result = "Empleado dado de baja correctamente";
                        }
                    } else{
                        $result = "Error al modificar en la BD";
                    }
                    break;
            }

        $closeConex = @mysqli_close($conex);
    } else{
        $result = "Error en la conexion a la BD";
    }
    return $result;
    }
}
?>