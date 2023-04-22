<?php

    include_once "models/Encargo_motivoClass.php";

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'GET':
            if (isset($_GET["idEncargo"])) {
                echo json_encode(Encargo_Motivo::getByIdEncargo($_GET));
            } 
            break;
        
        case 'GET':
            $datos = json_decode(file_get_contents("php://input"));
            if ($datos) {
                if (Encargo_Motivo::insert($datos-> idEncargo, $datos-> idMotivo)) {
                    http_response_code(200);
                } else {
                    http_response_code(400);
                }
                
            } else {
                http_response_code(405);
            }
            
            break;

        default:
            # code...
            break;
    }
?>