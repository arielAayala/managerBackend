<?php

    include_once "connectionDB/ConnectionDB.PHP";

    class Contactos{

        public static function getByIdPsicopedagogo($idPsicopedagogo){
            $con = new Connection();
            $query = "SELECT idContacto, numeroContacto FROM contactos WHERE idPsicopedagogo = $idPsicopedagogo";
            $datos = [];
            $resultado = $con -> query($query);
            if ($resultado -> num_rows >=0){
                while( $row = $resultado -> fetch_assoc()){
                    $datos[] =[
                        "idContacto" => $row["idContacto"],
                        "numeroContacto" => $row["numeroContacto"],
                    ];
                }
            }

            return $datos;
        }

    }

?>