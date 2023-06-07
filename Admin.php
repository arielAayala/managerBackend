<?php

include_once "models/AdminClass.php";

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: JSON");

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            $datos = json_decode(file_get_contents("php://input"));
            if ($datos){
                if (Admin::loginAdmin($datos->correoUsuario, $datos-> contrasenaUsuario)) {
                    http_response_code(200);
                } else {
                    http_response_code(400);
                }
                
            }else{
                http_response_code(400);
            }
            break;

    }


?>