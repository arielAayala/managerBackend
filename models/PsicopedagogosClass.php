<?php

include_once "connectionDB/ConnectionDB.php";

class Psicopedagogos{

    public static function getAll(){
        $con = new Connection();
        $query = "SELECT idPsicopedagogo, descripcionPsicopedagogo, nombrePsicopedagogo, fotoPsicopedagogo, nacimientoPsicopedagogo, especialidadPsicopedagogo, TIMESTAMPDIFF(YEAR, nacimientoPsicopedagogo, NOW()) AS edadPsicopedagogo
        FROM psicopedagogos";
        $resultado = $con->query($query);
        $datos=[];
        if($resultado->num_rows>=0){
            while($row = $resultado->fetch_assoc() ){
                $datos[]=[
                    "idPsicopedagogo" => $row["idPsicopedagogo"],
                    "descripcionPsicopedagogo" => $row["descripcionPsicopedagogo"],
                    "nombrePsicopedagogo" => $row["nombrePsicopedagogo"],
                    "fotoPsicopedagogo" => $row["fotoPsicopedagogo"],
                    "edadPsicopedagogo" => $row["edadPsicopedagogo"],
                    "nacimientoPsicopedagogo" => $row["nacimientoPsicopedagogo"],
                    "especialidadPsicopedagogo" => $row["especialidadPsicopedagogo"]
                ];
            }
        }
        return $datos;
    }


    public static function getById($idPsicopedagogo){
        $con = new Connection();
        $query = "SELECT idPsicopedagogo, descripcionPsicopedagogo, nombrePsicopedagogo, fotoPsicopedagogo, nacimientoPsicopedagogo, especialidadPsicopedagogo, TIMESTAMPDIFF(YEAR, nacimientoPsicopedagogo, NOW()) AS edadPsicopedagogo FROM psicopedagogos WHERE idPsicopedagogo = $idPsicopedagogo";
        $resultado = $con->query($query);
        $datos=[];
        if($resultado->num_rows>=0){
            while($row = $resultado-> fetch_assoc()){
                $datos[]=[
                    "idPsicopedagogo" => $row["idPsicopedagogo"],
                    "descripcionPsicopedagogo" => $row["descripcionPsicopedagogo"],
                    "nombrePsicopedagogo" => $row["nombrePsicopedagogo"],
                    "fotoPsicopedagogo" => $row["fotoPsicopedagogo"],
                    "edadPsicopedagogo" => $row["edadPsicopedagogo"],
                    "nacimientoPsicopedagogo" => $row["nacimientoPsicopedagogo"],
                    "especialidadPsicopedagogo" => $row["especialidadPsicopedagogo"]
                ];
            }
        }
        return($datos);
    }

    public static function insert( $nombrePsicopedagogo, $dniPsicopedagogo, $nacimientoPsicopedagogo){

        if( !(strlen(strval($dniPsicopedagogo)) == 8) && !(is_numeric($dniPsicopedagogo)) ){
            return FALSE;
        }
        $nombrePsicopedagogo =strtolower($nombrePsicopedagogo);
        $con = new Connection();
        $query = "INSERT INTO psicopedagogos(nombrePsicopedagogo, dniPsicopedagogo, nacimientoPsicopedagogo) VALUES(
            '$nombrePsicopedagogo',
            $dniPsicopedagogo,
            '$nacimientoPsicopedagogo'
        )";
        
        if ($con ->query($query)){
            $idPsicopedagogo = $con -> insert_id;
            $queryUsuario = "INSERT INTO usuarios(idUsuario, idPsicopedagogo, correoUsuario, contrasenaUsuario) VALUES(
                $idPsicopedagogo,
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
        
        if( !(strlen(strval($dniPsicopedagogo)) == 8) && !(is_numeric($dniPsicopedagogo)) ){
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