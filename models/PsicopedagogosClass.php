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
        $con = new Connection();
        $query = "INSERT INTO psicopedagogos(nombrePsicopedagogo, dniPsicopedagogo, nacimientoPsicopedagogo) VALUES(
            '$nombrePsicopedagogo',
            $dniPsicopedagogo,
            '$nacimientoPsicopedagogo'
        )";
        
        if ($con ->query($query)){
            $idPsicopedagogo = $con -> insert_id;
            $contrasenaPsicopedagogo = password_hash(strval($dniPsicopedagogo) , PASSWORD_DEFAULT);
            $queryUsuario = "INSERT INTO usuarios(idPsicopedagogo, correoUsuario, contrasenaUsuario) VALUES(
                $idPsicopedagogo,
                '".($correoPsicopedagogo = str_replace(" ", "",$nombrePsicopedagogo))."@devtics.edu.ar',
                '$contrasenaPsicopedagogo')";
            if($con -> query($queryUsuario)){
                return TRUE;
            }
        }
        return FALSE;
    }

    public static function update($idPsicopedagogo, $nombrePsicopedagogo, $dniPsicopedagogo, $nacimientoPsicopedagogo){
        $con = new Connection();
        $query = "UPDATE psicopedagogos SET
        idPsicopedagogo = $idPsicopedagogo,
        nombrePsicopedagogo = '$nombrePsicopedagogo',
        dniPsicopedagogo = $dniPsicopedagogo,
        nacimientoPsicopedagogo = '$nacimientoPsicopedagogo'";
        if ($con -> query($query)){
            return TRUE;
        }
        return FALSE;
    } 
}


?>