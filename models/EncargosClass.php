<?php
    require_once "connectionDB/ConnectionDB.php";


    class Encargos{

        public static function getAll(){
            $db = new Connection();
            $query = "SELECT e.idEncargo, e.tituloEncargo, t.nombreTipo, estados.nombreEstado, i.nombreInstitucion, e.fechaCreacionEncargo, e.fechaCierreEncargo, e.descripcionEncargo,e.idUsuarioCreador,
            p.nombrePsicopedagogo as nombreCreador,p.fotoPsicopedagogo as fotoCreador  ,e.idUsuarioResponsable,
            d.nombrePsicopedagogo as nombreResponsable, d.fotoPsicopedagogo as fotoResponsable FROM encargos e 
            INNER JOIN tipos t ON e.idTipo = t.idTipo 
            INNER JOIN estados ON e.idEstado = estados.idEstado 
            INNER JOIN instituciones i ON e.idInstitucion = i.idInstitucion 
            INNER JOIN usuarios u ON e.idUsuarioCreador = u.idUsuario 
            INNER JOIN psicopedagogos p ON u.idPsicopedagogo = p.idPsicopedagogo 
            INNER JOIN usuarios s ON e.idUsuarioResponsable = s.idUsuario 
            INNER JOIN psicopedagogos d ON d.idPsicopedagogo = s.idPsicopedagogo";
            $resultado = $db->query($query);
            $datos =[];
            if($resultado->num_rows>=0){
                while($row = $resultado->fetch_assoc() ){
                    $datos[] =[
                        "idEncargo" => $row["idEncargo"],
                        "tituloEncargo" => $row["tituloEncargo"],
                        "nombreTipo" => $row["nombreTipo"],
                        "nombreEstado" => $row["nombreEstado"],
                        "idUsuarioCreador" => $row["idUsuarioCreador"],
                        "nombreCreador" => $row["nombreCreador"],
                        "fotoCreador" => $row["fotoCreador"],
                        "idUsuarioResponsable" => $row["idUsuarioResponsable"],
                        "nombreResponsable" => $row["nombreResponsable"],
                        "fotoResponsable" => $row["fotoResponsable"],
                        "nombreInstitucion" => $row["nombreInstitucion"],
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