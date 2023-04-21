<?php

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
                        "idLocalidad" => $row["idLocalidad"],
                        "nombreResponsableInstitucion" => $row["nombreResponsableInstitucion"],
                        "domicilioInstitucion" =>$row["domicilioInstitucion"]
                    ];
                }
            }
            return $datos; 
        }

        public static function insert($nombreInstitucion){

        }
    }

?>