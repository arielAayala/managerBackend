<?php

    include_once "connectionDB/ConnectionDB.php";

    class Instituciones{

        public static function getAll(){
            $con = new Connection();
            $query = "SELECT * FROM instituciones";
            $datos = [];
            $resultado = $con -> query($query);
            if($resultado-> num_rows >= 0){
                while ($row = $resultado->fetch_assoc() ) {
                    $datos[]=[
                        "idInstitucion" => $row["idInstitucion"],
                        "nombreInstitucion" => $row["nombreInstitucion"],
                    ];
                }
            }
            return $datos; 
        }

        public static function insert($nombreInstitucion, $idLocalidad, $nombreResponsableInstitucion, $domicilioInstitucion){


            $con = new Connection();
            $query = "INSERT INTO instituciones(nombreInstitucion, idLocalidad, responsableInstitucion, domicilioInstitucion) VALUES(
                '$nombreInstitucion',
                $idLocalidad,
                '$nombreResponsableInstitucion',
                '$domicilioInstitucion'
            )";
            if ($con-> query($query)){
                return TRUE;
            }else{  
                return FALSE;
            }
        }
    }

?>