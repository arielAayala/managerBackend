<?php

include_once "connectionDB/ConnectionDB.php";

class Admin{

    public static function loginAdmin($correo, $pass){

        $con = new Connection();
        $query = "SELECT * FROM usuarios WHERE '$correo' = 'admin@admin.com' AND  '$pass' = 'admin123' AND idUsuario = 1";
        if ($con -> query($query)) {
            return TRUE;
        }
        echo $con -> error;
        return FALSE;
    }

}

?>