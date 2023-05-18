<?php
    require_once "connectionDB/ConnectionDB.php";


    class Encargos{

        public static function getAll(){
            $db = new Connection();
            $query = "SELECT e.idEncargo, e.tituloEncargo, estados.nombreEstado, e.fechaCreacionEncargo, d.nombrePsicopedagogo as nombreResponsable, d.fotoPsicopedagogo as fotoResponsable, CONCAT('[', GROUP_CONCAT( CONCAT('{\"nombreMotivo\": \"',m.nombreMotivo,'\"}')), ']') as motivosEncargo FROM encargos e INNER JOIN estados ON e.idEstado = estados.idEstado LEFT JOIN usuarios s ON e.idUsuarioResponsable = s.idUsuario LEFT JOIN psicopedagogos d ON d.idPsicopedagogo = s.idPsicopedagogo LEFT JOIN encargos_motivos em ON em.idEncargo = e.idEncargo LEFT JOIN motivos m ON em.idMotivo = m.idMotivo GROUP BY e.idEncargo, e.tituloEncargo, estados.nombreEstado, e.fechaCreacionEncargo, nombreResponsable, fotoResponsable";
            $resultado = $db->query($query);
            $datos =[];
            if($resultado->num_rows>=0){
                while($row = $resultado->fetch_assoc() ){
                    $datos[] =[
                        "idEncargo" => $row["idEncargo"],
                        "tituloEncargo" => $row["tituloEncargo"],
                        "nombreEstado" => $row["nombreEstado"],
                        "nombreResponsable" => $row["nombreResponsable"],
                        "fotoResponsable" => $row["fotoResponsable"],
                        "fechaCreacionEncargo" => $row["fechaCreacionEncargo"],
                        "motivosEncargo" => json_decode($row["motivosEncargo"], true)
                    ];
                }
            }
            return $datos;
        }

        public static function getById($idEncargo){
            $con = new Connection();
            $query = "SELECT e.idEncargo, e.tituloEncargo, e.idTipo,e.idEstado,e.idInstitucion,t.nombreTipo, estados.nombreEstado, i.nombreInstitucion, e.fechaCreacionEncargo, e.fechaCierreEncargo, e.descripcionEncargo, 
            e.idUsuarioCreador, p.nombrePsicopedagogo as nombreCreador, p.fotoPsicopedagogo as fotoCreador,
            e.idUsuarioResponsable, d.nombrePsicopedagogo as nombreResponsable, d.fotoPsicopedagogo as fotoResponsable 
            FROM encargos e 
            INNER JOIN tipos t ON e.idTipo = t.idTipo 
            INNER JOIN estados ON e.idEstado = estados.idEstado 
            INNER JOIN instituciones i ON e.idInstitucion = i.idInstitucion 
            INNER JOIN usuarios u ON e.idUsuarioCreador = u.idUsuario 
            INNER JOIN psicopedagogos p ON u.idPsicopedagogo = p.idPsicopedagogo 
            LEFT JOIN usuarios s ON e.idUsuarioResponsable = s.idUsuario 
            LEFT JOIN psicopedagogos d ON d.idPsicopedagogo = s.idPsicopedagogo
            WHERE e.idEncargo = $idEncargo";
            $resultado = $con->query($query);
            $datos =[];
            if($resultado->num_rows>=0){
                while($row = $resultado->fetch_assoc() ){
                    $datos[] =[
                        "idEncargo" => $row["idEncargo"],
                        "tituloEncargo" => $row["tituloEncargo"],
                        "nombreTipo" => $row["nombreTipo"],
                        "idTipo" => $row["idTipo"],
                        "nombreEstado" => $row["nombreEstado"],
                        "idEstado" => $row["idEstado"],
                        "idUsuarioCreador" => $row["idUsuarioCreador"],
                        "nombreCreador" => $row["nombreCreador"],
                        "fotoCreador" => $row["fotoCreador"],
                        "idUsuarioResponsable" => $row["idUsuarioResponsable"],
                        "nombreResponsable" => $row["nombreResponsable"],
                        "fotoResponsable" => $row["fotoResponsable"],
                        "nombreInstitucion" => $row["nombreInstitucion"],
                        "idInstitucion" => $row["idInstitucion"],
                        "fechaCreacionEncargo" => $row["fechaCreacionEncargo"],
                        "fechaCierreEncargo" => $row["fechaCierreEncargo"],
                        "descripcionEncargo" => $row["descripcionEncargo"],
                    ];
                }
            }
            return $datos;
        }

        public static function insert($tituloEncargo,$idTipo,$idEstado,$idUsuarioCreador,$idUsuarioResponsable,$idInstitucion,$fechaCreacionEncargo,$descripcionEncargo){
            
            $con = new Connection();
            $idUsuarioResponsable = $idUsuarioResponsable ? $idUsuarioResponsable: NULL;
            $query = "INSERT INTO encargos (tituloEncargo,idTipo,idEstado,idUsuarioCreador,idUsuarioResponsable,idInstitucion,fechaCreacionEncargo,fechaCierreEncargo,descripcionEncargo) VALUES (
                '$tituloEncargo',
                $idTipo, 
                $idEstado,
                $idUsuarioCreador,
                $idUsuarioResponsable, 
                $idInstitucion, 
                '$fechaCreacionEncargo', 
                NULL,
                '$descripcionEncargo'
            );";
            
            if ($con -> query($query)){
                return TRUE;
            }
            echo $con -> error;
            return FALSE;
        }

        public static function update($idEncargo, $tituloEncargo,$idTipo,$idEstado,$idUsuarioResponsable,$idInstitucion,$descripcionEncargo){
            $con = new Connection();
            $query = "UPDATE encargos SET tituloEncargo = '$tituloEncargo', idTipo = $idTipo, idEstado = $idEstado,  idUsuarioResponsable = $idUsuarioResponsable, idInstitucion = $idInstitucion, descripcionEncargo = '$descripcionEncargo'
            WHERE idEncargo = $idEncargo";
            if ($con -> query($query)){
                return TRUE;
            }
            return FALSE;
        }

    }
?>