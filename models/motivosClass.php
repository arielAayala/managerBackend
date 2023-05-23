<?php

    include_once "connectionDB/ConnectionDB.php";

    class Motivos{

        public static function getAll (){
            $con = new Connection;
            $query = "SELECT idMotivo, nombreMotivo FROM motivos";
            $datos = [];
            $resultado = $con -> query($query);
            if ($resultado -> num_rows >=0) {
                while ($row = $resultado-> fetch_assoc()) {
                    $datos[] = [
                        "idMotivo" => $row["idMotivo"],
                        "nombreMotivo" => $row["nombreMotivo"],
                    ];
                }
            }
            
            return $datos;
        }

    }

?>