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
            if(!(is_int($idLocalidad))){
                return FALSE;
            }

            if( strlen($nombreInstitucion)== 0 && strlen($domicilioInstitucion) == 0 && strlen($nombreResponsableInstitucion)== 0){
                return FALSE;
            }

            $con = new Connection();
            $query = "INSERT INTO instituciones(nombreInstitucion, idLocalidad, nombreResponsableInstitucion, domicilioInstitucion) VALUES(
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