<?php
    require_once "connectionDB/ConnectionDB.php";


    class Encargos{

        public static function getAll(){
            $db = new Connection();
            $query = "SELECT * FROM encargos";
            $resultado = $db->query($query);
            $datos =[];
            if($resultado->num_rows>=0){
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
            if($resultado->num_rows>=0){
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

        public static function insert($idTipo,$idEstado,$idUsuarioCreador,$idUsuarioResponsable,$idInstitucion,$fechaCreacionEncargo,$descripcionEncargo){
            function validateDate($date, $format = 'Y-m-d'){
                $d = DateTime::createFromFormat($format, $date);
                return $d && $d->format($format) === $date;
            }
    
            if (!(validateDate($fechaCreacionEncargo))){
                return FALSE;
            }

            if(!(is_int($idUsuarioResponsable)) && !($idUsuarioResponsable == NULL)){
                return FALSE;
            }

            if(!(is_int($idTipo)) || !(is_int($idEstado)) || !(is_int($idUsuarioCreador)) || !(is_int($idInstitucion))){
                return FALSE;
            }
            
            $con = new Connection();
            $idUsuarioResponsable = $idUsuarioResponsable ? NULL : $idUsuarioResponsable;
            $query = "INSERT INTO encargos (idTipo,idEstado,idUsuarioCreador,idUsuarioResponsable,idInstitucion,fechaCreacionEncargo,fechaCierreEncargo,descripcionEncargo) VALUES (
                $idTipo, 
                $idEstado,
                $idUsuarioCreador,
                " . ($idUsuarioResponsable ? $idUsuarioResponsable : 'NULL') . ", 
                $idInstitucion, 
                '$fechaCreacionEncargo', 
                'NULL',
                '$descripcionEncargo'
            )";
            if ($con -> query($query)){
                return TRUE;
            }
            return FALSE;
        }

        public static function update($idEncargo,$idTipo,$idEstado,$idUsuarioResponsable,$idInstitucion,$fechaCierreEncargo,$descripcionEncargo){

            function validateDate($date, $format = 'Y-m-d'){
                $d = DateTime::createFromFormat($format, $date);
                return $d && $d->format($format) === $date;
            }
    
            if (!(validateDate($fechaCierreEncargo)) && !($fechaCierreEncargo == NULL)){
                return FALSE;
            }

            if(!(is_int($idUsuarioResponsable)) && !($idUsuarioResponsable == NULL)){
                return FALSE;
            }

            if(!(is_int($idTipo)) || !(is_int($idEstado))  || !(is_int($idUsuarioCreador)) || !(is_int($idInstitucion))){
                return FALSE;
            }

            $con = new Connection();
            $query = "UPDATE encargos SET 
            IdTipo = $idTipo, 
            idEstado = $idEstado,  
            idUsuarioResponsable = " . ($idUsuarioResponsable ? $idUsuarioResponsable : 'NULL') . ", 
            idInstitucion = $idInstitucion, 
            fechaCierreEncargo = '" . ($fechaCierreEncargo ? $fechaCierreEncargo : 'NULL') . "', 
            descripcionEncargo = '$descripcionEncargo'
            WHERE idEncargo = $idEncargo";
            if ($con -> query($query)){
                return TRUE;
            }
            return FALSE;
        }

    }
?>