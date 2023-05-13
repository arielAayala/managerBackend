<?php

    include_once "models/UsuariosClass.php";

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Content-Type: JSON");
            $datos = json_decode(file_get_contents("php://input"));
            if ($datos){
                echo json_encode(Usuarios::login($datos -> correoUsuario, $datos -> contrasenaUsuario ));
            }else{
                echo json_encode([]);
            }
            break;

        case 'GET':
            header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Content-Type: JSON");
            echo json_encode(Usuarios::getAll());
        default:
            # code...
            break;
    }
?>