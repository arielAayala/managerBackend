<?php

    include_once "models/UsuariosClass.php";

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            header("Content-Type: JSON");
            $datos = json_decode(file_get_contents("php://input"));
            if ($datos){
                echo json_encode(Usuarios::login($datos -> correoUsuario, $datos -> contrasenaUsuario ));
            }else{
                echo json_encode([]);
            }
            break;

        default:
            # code...
            break;
    }
?>