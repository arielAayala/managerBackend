<?php

    include_once "connectionDB/ConnectionDB.PHP";

    class Anexos {

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

        public static function insert($idEncargo, $idNota, $urlAnexo){
            if ($idEncargo == NULL && $idNota == NULL) {
                return FALSE;
            }
            
            if (!(is_int($idEncargo))){
                return FALSE;
            }
            
            if (!(is_int($idNota)) && !($idNota == NULL)){
                return FALSE;
            }
            
            if (strlen($urlAnexo) == 0){
                return FALSE;   
            }
            
            $con = new Connection();
            $query = "INSERT INTO anexos(idEncargo, idNota, urlAnexo) VALUES(
                ".($idEncargo ? $idEncargo : 'NULL').",
                ".($idNota ? $idNota : 'NULL').",
                '$urlAnexo'
            )";

            if( $con -> query($query)){
                return TRUE;
            }else{
                return FALSE;
            }
        }

    }

?>