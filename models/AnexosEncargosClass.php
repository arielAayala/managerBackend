<?php

    include_once "connectionDB/ConnectionDB.PHP";

    class EncargosAnexos {

        public static function getByIdEncargo($idEncargo){
            $con = new Connection();
            $query = "SELECT * FROM encargos_anexos WHERE idEncargo = $idEncargo";
            $datos = [];
            $resultado = $con -> query($query);
            if ($resultado -> num_rows >=0){
                while( $row = $resultado -> fetch_assoc()){
                    $datos[] =[
                        "idEncargoAnexo" => $row["idEncargoAnexo"],
                        "idEncargo" => $row["idEncargo"],
                        "urlEncargoAnexo" => $row["urlEncargoAnexo"],
                    ];
                }
            }

            return $datos;
        }

        public static function insert($idEncargo, $urlEncargoAnexo){
            
            $con = new Connection();
            $query = "INSERT INTO anexos( idEncargo, urlEncargoAnexo) VALUES(
                $idEncargo,
                '$urlEncargoAnexo'
            )";

            if( $con -> query($query)){
                return TRUE;
            }else{
                return FALSE;
            }
        }

    }

?>