<?php
    require_once "connectionDB/ConnectionDB.php";


    class Encargos{

        public static function getAll(){
            $db = new Connection();
            $query = "SELECT * FROM encargos";
            $resultado = $db->query($query);
            $datos =[];
            if($resultado->num_rows){
                while($row = $resultado->fetch_assoc() ){
                    $datos[] =[
                        "idEncargo" => $row["idEncargo"],
                        "idTipo" => $row["idTipo"],
                        "idEstado" => $row["idEstado"],
                        "idUsuarioCreador" => $row["idUsuarioCreador"],
                        "idUsuarioResponsable" => $row["idUsuarioResponsable"],
                        "idInstitucion" => $row["idInstitucion"],
                        "fechaCreacionEncargo" => $row["fechaCreacionEncargo"],
                        "fechaCierreEncargo" => $row["fechaCierreEncargo"],
                        "descripcionEncargo" => $row["descripcionEncargo"],
                    ];
                }
            }
            return $datos;
        }

        public static function getById($idEncargo){
            $con = new Connection();
            $query = "SELECT * FROM encargos WHERE idEncargo = $idEncargo";
            $resultado = $con->query($query);
            $datos =[];
            if($resultado->num_rows){
                while($row = $resultado->fetch_assoc() ){
                    $datos[] =[
                        "idEncargo" => $row["idEncargo"],
                        "idTipo" => $row["idTipo"],
                        "idEstado" => $row["idEstado"],
                        "idUsuarioCreador" => $row["idUsuarioCreador"],
                        "idUsuarioResponsable" => $row["idUsuarioResponsable"],
                        "idInstitucion" => $row["idInstitucion"],
                        "fechaCreacionEncargo" => $row["fechaCreacionEncargo"],
                        "fechaCierreEncargo" => $row["fechaCierreEncargo"],
                        "descripcionEncargo" => $row["descripcionEncargo"],
                    ];
                }
            }
            return $datos;
        }


        public static function insert($idTipo,$idEstado,$idUsuarioCreador,$idUsuarioResponsable,$idInstitucion,$fechaCreacionEncargo,$fechaCierreEncargo,$descripcionEncargo){
            $con = new Connection();
            $query = "INSERT INTO encargos(idEncargo,IdTipo,idEstado,idUsuarioCreador,IdUsuarioResponsable,idInstitucion,fechaCreacionEncargo,fechaCierreEncargo,descripcionEncargo) VALUES ('".NULL."','$idTipo','$idEstado','$idUsuarioCreador','$idUsuarioResponsable','$idInstitucion','$fechaCreacionEncargo','$fechaCierreEncargo','$descripcionEncargo')";
            if ($con -> query($query)){
                echo "se cargo";
                return TRUE;
            }
            echo $con -> errno;
            return FALSE;
        }

        public static function update($idEncargo,$idTipo,$idEstado,$idUsuarioCreador,$idUsuarioResponsable,$idInstitucion,$fechaCreacionEncargo,$fechaCierreEncargo,$descripcionEncargo){
            $con = new Connection();
            $query = "UPDATE encargo SET IdTipo = '$idTipo', idEstado = '$idEstado, idUsuarioCreador ='$idUsuarioCreador', IdUsuarioResponsable = '$idUsuarioResponsable',idInstitucion = '$idInstitucion', fechacreacionEncargo = '".$fechaCreacionEncargo."', fechaCierreEncargo = '".$fechaCierreEncargo."', descripcionEncargo = '".$descripcionEncargo."' WHERE idEncargo = $idEncargo";
            $con -> query($query);
            if ($con -> affcted_rows){
                return TRUE;
            }
            return FALSE;
        }

        public static function delete($idEncargo){
            $con = new Connection();
            $query = "DELETE FROM encargos WHERE idEncargo = $idEncargo";
            $con -> query($query);
            if ($con -> affcted_rows){
                return TRUE;
            }
            return FALSE;
        }

    }
?>