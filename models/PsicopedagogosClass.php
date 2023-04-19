<?php

include_once "connectionDB/ConnectionDB.php";

class Psicopedagogos{

    public static function getAll(){
        $con = new Connection();
        $query = "SELECT * FROM psicopedagogos";
        $resultado = $con->query($query);
        $datos=[];
        if($resultado->num_rows){
            while($row = $resultado->fetch_assoc() ){
                $datos[]=[
                    "idPsicopedagogo" => $row["idPsicopedagogo"],
                    "nombrePsicopedagogo" => $row["nombrePsicopedagogo"],
                    "dniPsicopedagogo" => $row["dniPsicopedagogo"],
                    "nacimientoPsicopedagogo" => $row["nacimientoPsicopedagogo"],
                ];
            }
        }
        return $datos;
    }


    public static function getById($idPsicopedagogo){
        $con = new Connection();
        $query = "SELECT * FROM psicopedagogos WHERE idpsicopedagogo = $idPsicopedagogo";
        $resultado = $con->query($query);
        $datos=[];
        if($resultado->num_rows){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    "idPsicopedagogo" => $row["idPsicopedagogo"],
                    "nombrePsicopedagogo" => $row["nombrePsicopedagogo"],
                    "dniPsicopedagogo" => $row["dniPsicopedagogo"],
                    "nacimientoPsicopedagogo" => $row["nacimientoPsicopedagogo"],
                ];
            }
        }
        return($datos);
    }

    public static function insert( $nombrePsicopedagogo, $dniPsicopedagogo, $nacimientoPsicopedagogo){
        if (!(is_string($nombrePsicopedagogo)) && !(strlen($nombrePsicopedagogo) > 0 ) ){
            return FALSE;
        }
        if( !(strlen(strval($dniPsicopedagogo)) == 8) && !(is_numeric($dniPsicopedagogo)) ){
            return FALSE;
        }

        function validateDate($date, $format = 'Y-m-d'){
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) === $date;
        }

        if (!( validateDate($nacimientoPsicopedagogo))){
            return FALSE;
        }

        $con = new Connection();
        $query = "INSERT INTO psicopedagogos(nombrePsicopedagogo, dniPsicopedagogo, nacimientoPsicopedagogo) VALUES(
            '".strtolower($nombrePsicopedagogo)."',
            $dniPsicopedagogo,
            '$nacimientoPsicopedagogo'
        )";
        
        if ($con ->query($query)){
            $idPsicopedagogo = $con -> insert_id;
            $queryUsuario = "INSERT INTO usuarios(idPsicopedagogo, correoUsuario, contrasenaUsuario) VALUES(
                $idPsicopedagogo,
                '".($correoPsicopedagogo = str_replace(" ", "",strtolower($nombrePsicopedagogo)))."@devtics.edu.ar',
                '".password_hash(strval($dniPsicopedagogo) , PASSWORD_DEFAULT)."')";
            if($con -> query($queryUsuario)){
                return TRUE;
            }
        }
        return FALSE;
    }

    public static function update($idPsicopedagogo, $nombrePsicopedagogo, $dniPsicopedagogo, $nacimientoPsicopedagogo){
        if (!(is_string($nombrePsicopedagogo)) && !(strlen($nombrePsicopedagogo) > 0 ) ){
            return FALSE;
        }
        if( !(strlen(strval($dniPsicopedagogo)) == 8) && !(is_numeric($dniPsicopedagogo)) ){
            return FALSE;
        }

        function validateDate($date, $format = 'Y-m-d'){
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) === $date;
        }

        if (!( validateDate($nacimientoPsicopedagogo))){
            return FALSE;
        }

        $con = new Connection();
        $query = "UPDATE psicopedagogos SET
        nombrePsicopedagogo = '".strtolower($nombrePsicopedagogo)."',
        dniPsicopedagogo = $dniPsicopedagogo,
        nacimientoPsicopedagogo = '$nacimientoPsicopedagogo'
        WHERE idPsicopedagogo = $idPsicopedagogo";

        $queryUsuario = "UPDATE usuarios SET
        correoUsuario = '".$correoPsicopedagogo = strtolower(str_replace(" ", "",$nombrePsicopedagogo))."@devtics.edu.ar',
        contrasenaUsuario = '".password_hash($dniPsicopedagogo,PASSWORD_DEFAULT)."'
        WHERE idPsicopedagogo = $idPsicopedagogo";


        if ($con -> query($query) && $con -> query($queryUsuario)){
            return TRUE;
        }
        echo $con -> errno;
        return FALSE;
    } 
}


?>