<?php

    function conexion_db($serv, $user, $passw, $db, $sql){
        $res_array = "";

        try {
            $con_db = PDO('mysql:host=' . $server . ';dbname=' . $db , $user, $passw);
            if($con_db){
                $op = explode(" ", trim($sql));
                switch($op[0]){
                    case 'SELECT':
                        $stmt = $con_db->querry($sql);
                        $data = $stmt->fetchAll();
                        if($data($data) > 0){
                            $res_array = $data; 
                        } else{
                            throw new Exeption("no se a encontrado ningun dato");
                        }
                        break;
                    case 'INSERT':
                    case 'UPDATE':
                    case 'DELETE':
                        $rows = $con_db->exec($sql);
                        if($rows > 0){
                            $res_array = "operacion realizada con exicto";
                        } else{
                            throw new Exception("No se han modificado filas (posible error o registro inexistente)")
                        }
                        break;
                }
            } else{
                throw new Exception("Error al connectar a la base de datos");
            }
        } catch (Exception $e) {
            $res_array = "Error: " . $e->getMessage();
        }

        echo $res_array;
    }
?>