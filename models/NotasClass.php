<?php 
    include_once "connectionDB/ConnectionDB.php";

    class Notas{
        /* Funcion para crear Notas en la base de datos, tambien se valida los datos  */

        
        public static function insert($idEncargo, $idUsuarioCreador,  $comentarioNota){
            $idNuevoResponsable =  'NULL';
            $con = new Connection();
            $query = "INSERT INTO notas(idEncargo, idUsuarioCreador, idNuevoResponsable, fechaCreacionNota, comentarioNota) VALUES(
                $idEncargo,
                $idUsuarioCreador,
                $idNuevoResponsable, 
                CURDATE(),
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