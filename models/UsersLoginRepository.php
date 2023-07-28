<?php

include_once "connectionDB/ConnectionDB.php";



class UsersLogin{

    public static function Login($correo, $contrasena):array{
        $con = new Connection();
        $query = "SELECT u.correoUsuario, u.contrasenaUsuario, u.idUsuario , u.fotoUsuario, u.nombreUsuario FROM usuarios u  WHERE U.correoUsuario = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datos = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                if ( $contrasena == $row["contrasenaUsuario"]) {
                    $datos []= [
                        "idUsuario" => $row["idUsuario"],
                        "fotoUsuario" => $row["fotoUsuario"],
                        "nombreUsuario" => $row["nombreUsuario"]
                    ];
                } 
            }
        }
        return $datos;
    }
    
    public static function GetUserData($id){
        $con = new Connection();
        $query = "SELECT  u.idUsuario , u.fotoUsuario, u.nombreUsuario FROM usuarios u  WHERE u.idUsuario = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datos = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $datos []= [
                    "idUsuario" => $row["idUsuario"],
                    "fotoUsuario" => $row["fotoUsuario"],
                    "nombreUsuario" => $row["nombreUsuario"]
                ];
            }
        }
        return $datos;
    } 
}

?>