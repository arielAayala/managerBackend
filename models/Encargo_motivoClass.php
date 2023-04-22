<?php

    include_once "connectionDB/ConnectionDB.php";

    class Encargo_Motivo{

        public static function getByIdEncargo($idEncargo){

            $con = new Connection();
            $query = "SELECT Motivos_idMotivo FROM idEncargo=$idEncargo";        
            $datos = [];
            $resultado = $con -> query($query);
            if($resultado->num_rows >= 0){
                while($row= $resultado->fetch_assoc()){
                    $datos[]=[
                        "motivos_idMotivo" => $row["motivos_idMotivo"]
                    ];
                }
            }
            return $datos;
        }

        public static function insert($idEncargo, $idMotivo){
            if (!(is_int($idEncargo)) || !(is_int($idMotivo)) ) {
                return FALSE;
            }

            $con = new Connection();
            $query = "INSERT INTO encargos_motivos(Encargos_idEncargo, Motivos_idMotivo) VALUES(
                $idEncargo,
                $idMotivo
            )";
            if($con-> query($query)){
                return TRUE;
            }else{
                return FALSE;
            }
        }

    }

?>