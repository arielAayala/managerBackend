<?php

    include_once "models/UsuariosClass.php";

    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Content-Type: JSON");
    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            $datos = json_decode(file_get_contents("php://input"));
            if ($datos){
                echo json_encode(Usuarios::login($datos -> correoUsuario, $datos -> contrasenaUsuario ));
            }else{
                echo json_encode([]);
            }
            break;

        case 'GET':
            echo json_encode(Usuarios::getAll());
        default:
            # code...
            break;
    }
?>