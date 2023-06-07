<?php
    require_once "connectionDB/ConnectionDB.php";


    class Encargos{

        public static function getAll(){
            $db = new Connection();
            $query = "SELECT idEncargo, descripcionEncargo ,idMotivo, idInstitucion, nombreInstitucion ,idTipo, tituloEncargo, idEstado, nombreEstado, fechaCreacionEncargo, idUsuarioCreador,  nombreCreador,  fotoCreador,
            idUsuarioResponsable , nombreResponsable,  fotoResponsable, nombreMotivo, nombreTipo 
            FROM vista_encargos";
            $resultado = $db->query($query);
            $datos =[];
            if($resultado->num_rows>=0){
                while($row = $resultado->fetch_assoc() ){
                    $datos[] =[
                        "idEncargo" => $row["idEncargo"],
                        "tituloEncargo" => $row["tituloEncargo"],
                        "nombreEstado" => $row["nombreEstado"],
                        "idEstado" => $row["idEstado"],
                        "nombreTipo" => $row["nombreTipo"],
                        "idTipo" => $row["idTipo"],
                        "nombreMotivo" => $row["nombreMotivo"],
                        "idMotivo" => $row["idMotivo"],
                        "idInstitucion" => $row["idInstitucion"],
                        "nombreInstitucion" => $row["nombreInstitucion"],
                        "idUsuarioCreador" => $row["idUsuarioCreador"],
                        "nombreCreador" => $row["nombreCreador"],
                        "fotoCreador" => $row["fotoCreador"],
                        "idUsuarioResponsable" => $row["idUsuarioResponsable"],
                        "nombreResponsable" => $row["nombreResponsable"],
                        "fotoResponsable" => $row["fotoResponsable"],
                        "fechaCreacionEncargo" => $row["fechaCreacionEncargo"],
                        "descripcionEncargo" => $row["descripcionEncargo"],
                    ];
                }
            }
            return $datos;
        }

        public static function getById($idEncargo){
            $con = new Connection();
            $query = "SELECT idEncargo, descripcionEncargo,fechaCierreEncargo ,idMotivo, idInstitucion, nombreInstitucion ,idTipo, tituloEncargo, idEstado, nombreEstado, fechaCreacionEncargo, idUsuarioCreador,  nombreCreador,  fotoCreador,
            idUsuarioResponsable , nombreResponsable,  fotoResponsable, nombreMotivo, nombreTipo 
            FROM vista_encargos
            WHERE idEncargo = $idEncargo";
            $resultado = $con->query($query);
            $datos =[];
            if($resultado->num_rows>=0){
                while($row = $resultado->fetch_assoc() ){
                    $datos[] =[
                        "idEncargo" => $row["idEncargo"],
                        "tituloEncargo" => $row["tituloEncargo"],
                        "nombreEstado" => $row["nombreEstado"],
                        "idEstado" => $row["idEstado"],
                        "nombreTipo" => $row["nombreTipo"],
                        "idTipo" => $row["idTipo"],
                        "nombreMotivo" => $row["nombreMotivo"],
                        "idMotivo" => $row["idMotivo"],
                        "idInstitucion" => $row["idInstitucion"],
                        "nombreInstitucion" => $row["nombreInstitucion"],
                        "idUsuarioCreador" => $row["idUsuarioCreador"],
                        "nombreCreador" => $row["nombreCreador"],
                        "fotoCreador" => $row["fotoCreador"],
                        "idUsuarioResponsable" => $row["idUsuarioResponsable"],
                        "nombreResponsable" => $row["nombreResponsable"],
                        "fotoResponsable" => $row["fotoResponsable"],
                        "fechaCreacionEncargo" => $row["fechaCreacionEncargo"],
                        "descripcionEncargo" => $row["descripcionEncargo"],
                        "fechaCierreEncargo" =>$row["fechaCierreEncargo"]
                    ];
                }
            }
            return $datos;
        }

        public static function insert($tituloEncargo,$idTipo,$idMotivo,$idUsuarioCreador,$idUsuarioResponsable,$idInstitucion,$descripcionEncargo){
            
            $con = new Connection();
            $idUsuarioResponsable = $idUsuarioResponsable== NULL ? 'NULL': $idUsuarioResponsable;
            $query = "INSERT INTO encargos (tituloEncargo, idTipo, idEstado, idMotivo, idUsuarioCreador, idUsuarioResponsable, idInstitucion, fechaCreacionEncargo, fechaCierreEncargo, descripcionEncargo) 
            VALUES (
                '$tituloEncargo',
                $idTipo,
                1,
                $idMotivo,
                $idUsuarioCreador,
                $idUsuarioResponsable,
                $idInstitucion,
                CURDATE(),
                NULL,
                '$descripcionEncargo'
            )";
            
            if ($con->query($query)) {
                echo json_encode( [ "idEncargo"=> $con ->  insert_id]);
                return TRUE;
            }
            echo $con->error;
            return FALSE;
            

        }

        public static function update($idEncargo, $tituloEncargo, $idTipo, $idEstado, $idUsuarioResponsable, $idInstitucion, $descripcionEncargo, $idMotivo, $fechaCierreEncargo) {
            $con = new Connection();
        
            $fechaCierreEncargo = $fechaCierreEncargo==TRUE ? "'" . (new DateTime())->format('Y-m-d') . "'" : 'NULL';

        
            $query = "UPDATE encargos SET 
                    tituloEncargo = '$tituloEncargo', 
                    idTipo = $idTipo, 
                    idEstado = $idEstado,  
                    idUsuarioResponsable = $idUsuarioResponsable, 
                    idInstitucion = $idInstitucion, 
                    descripcionEncargo = '$descripcionEncargo',
                    idMotivo = $idMotivo,
                    fechaCierreEncargo = $fechaCierreEncargo 
                    WHERE idEncargo = $idEncargo";
        
            echo $query;
            if ($con->query($query)) {
                return true;
            }
            echo $con-> error;
            return false;
        }
        


        public static function patch($idEncargo,$idUsuarioResponsable){
            $con = new Connection();
            $query = "UPDATE encargos SET idUsuarioResponsable =$idUsuarioResponsable WHERE idEncargo = $idEncargo";
            if ($con -> query($query)) {
                return TRUE;
            }
            return False;
        }
    }
?>