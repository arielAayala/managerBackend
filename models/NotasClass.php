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
                echo json_encode( [ "idNota"=> $con ->  insert_id]);
                return TRUE;
            }
            
            return FALSE;
        }// End Insert

        public static function getByIdEncargo($idEncargo){
            $con = new Connection();
            $query = "SELECT n.idNota, n.idEncargo, 
                n.idUsuarioCreador, p.nombrePsicopedagogo as nombreCreador, p.fotoPsicopedagogo as fotoCreador, 
                n.idNuevoResponsable, g.nombrePsicopedagogo as nombreNuevoResponsable, g.fotoPsicopedagogo as fotoNuevoResponsable, 
                n.fechaCreacionNota, n.comentarioNota, 
                CONCAT('[', GROUP_CONCAT(CONCAT('{','\"idNotaAnexo\":', na.idNotaAnexo, 
                ',\"nombreNotaAnexo\":','\"',na.nombreNotaAnexo,'\",', 
                '\"urlNotaAnexo\":' , '\"', na.urlNotaAnexo,'\"','}') SEPARATOR ','), ']') AS notasAnexo 
                FROM notas n 
                INNER JOIN usuarios u on n.idUsuarioCreador = u.idUsuario 
                INNER JOIN psicopedagogos p on u.idPsicopedagogo = p.idPsicopedagogo 
                LEFT JOIN usuarios s on n.idNuevoResponsable = s.idUsuario 
                LEFT JOIN psicopedagogos g on s.idPsicopedagogo = g.idPsicopedagogo 
                LEFT JOIN notas_anexos na on na.idNota = n.idNota 
                WHERE n.idEncargo = $idEncargo
                GROUP BY n.idNota ";
            $datos=[];
            $resultado = $con -> query($query);
            if ($resultado -> num_rows >= 0 ){
                while ($row = $resultado -> fetch_assoc()){
                    // Decodificar el campo "notasAnexo" de JSON a un objeto/array PHP
                    $notasAnexo = $row["notasAnexo"]; // Obtener el campo "notasAnexo" como cadena JSON
                    $row["notasAnexo"] = json_decode($notasAnexo);
                    $datos[] = $row;
                }
            }
            return $datos;
        }
        

    }

?>