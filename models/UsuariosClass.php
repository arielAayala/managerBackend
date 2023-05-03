<?php

include_once "connectionDB/ConnectionDB.php";

class Usuarios{

    public static function login($correoUsuario,$contrasenaUsuario){
        $con = new Connection();
        $query = "SELECT u.correoUsuario, u.contrasenaUsuario, u.idUsuario, p.nombrePsicopedagogo, p.dniPsicopedagogo, p.nacimientoPsicopedagogo,u.idPsicopedagogo FROM usuarios u INNER JOIN  psicopedagogos p ON p.idPsicopedagogo = u.idPsicopedagogo  WHERE correoUsuario = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $correoUsuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $datos = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                if (password_verify($contrasenaUsuario, $row["contrasenaUsuario"])) {
                    $datos[] = [
                        "idUsuario" => $row["idUsuario"],
                        "idPsicopedagogo" => $row["idPsicopedagogo"],
                        "nombrePsicopedagogo" =>$row["nombrePsicopedagogo"],
                        "dniPsicopedagogo" => $row["dniPsicopedagogo"],
                        "nacimientoPsicopedagogo" => $row["nacimientoPsicopedagogo"]
                    ];
                }
            }
        }
        return $datos;
    }   

}

?>