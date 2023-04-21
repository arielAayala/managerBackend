<?php 
    include_once "connectionDB/ConnectionDB.php";

    class Notas{
        /* Funcion para crear Notas en la base de datos, tambien se valida los datos  */
        public static function insert($idEncargo, $idUsuarioCreador, $idNuevoResponsable, $fechaCreacionNota, $comentarioNota){
            if(!(is_int($idNuevoResponsable)) && !($idNuevoResponsable == NULL)){
                echo "hola";
                return FALSE;
            }
            
            if(!(is_int($idEncargo)) ||  !(is_int($idUsuarioCreador)) ){
                return FALSE;
            }

            $con = new Connection();
            $query = "INSERT INTO notas(idEncargo, idUsuarioCreador, idNuevoResponsable, fechaCreacionNota, comentarioNota) VALUES(
                $idEncargo,
                $idUsuarioCreador,
                " . ($idNuevoResponsable ? $idNuevoResponsable : 'NULL') . ", 
                '$fechaCreacionNota',
                '$comentarioNota'
            )";
            if( $con ->query($query)){
                return TRUE;
            }
            
            return FALSE;
        }// End Insert

        public static function getByIdEncargo($idEncargo){
            $con = new Connection();
            $query = "SELECT * FROM notas WHERE idEncargo = $idEncargo";
            $datos=[];
            $resultado = $con -> query($query);
            if ($resultado -> num_rows >=0 ){
                while ($row = $resultado -> fetch_assoc()){
                    $datos[]=[
                        "idNota" => $row["idNota"],
                        "idEncargo" => $row["idEncargo"],
                        "idUsuarioCreador" => $row["idUsuarioCreador"],
                        "idNuevoResponsable" => $row["idNuevoResponsable"],
                        "fechaCreacionNota" => $row["fechaCreacionNota"],
                        "comentarioNota" => $row["comentarioNota"]
                    ];
                }
            }
            return $datos;
        }

    }

?>