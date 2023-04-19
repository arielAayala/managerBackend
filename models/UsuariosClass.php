<?php

include_once "connectionDB/ConnectionDB.php";

class Usuarios{

    public static function login($correoUsuario,$contrasenaUsuario){
        $con = new Connection();
        /* $contrasenaUsuario = password_hash($contrasenaUsuario, PASSWORD_DEFAULT); */
        $query = "SELECT * FROM usuarios WHERE contrasenaUsuario = $contrasenaUsuario AND correoUsuario = '$correoUsuario'";
        $datos = [];
        $resultado = $con -> query($query);
        if ( $resultado -> num_rows){
            while ($row = $resultado->fetch_assoc()){
                $datos[] =[
                    "idUsuario" => $row["idUsuario"],
                    "idPsicopedagogo" => $row["idPsicopedagogo"],
                    "correoUsuario" => $row["correoUsuario"],
                    "contrasenaUsuario" => $row["contrasenaUsuario"],
                ];
            }
        }
        return $datos;
    }   

    public static function getAll (){
        $con = new Connection();
        $query = "SELECT * FROM usuarios";
        $datos = [];
        $resultado = $con -> query($query);
        if ( $resultado -> num_rows){
            while ($row = $resultado->fetch_assoc()){
                $datos[] =[
                    "idUsuario" => $row["idUsuario"],
                    "idPsicopedagogo" => $row["idPsicopedagogo"],
                    "correoUsuario" => $row["correoUsuario"],
                    "contrasenaUsuario" => $row["contrasenaUsuario"],
                ];
            }
        }
        return $datos;
    }
}

?>