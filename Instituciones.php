<?php

    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: GET, POST, ");
    header("Content-Type: JSON");
    include_once "models/InstitucionesClass.php";

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'GET':
            header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Content-Type: JSON");
            echo json_encode(Instituciones::getAll());
            break;
        
        case 'POST':
            $datos = json_decode(file_get_contents("php://input"));
            if ($datos) {
                if (Instituciones::insert($datos-> nombreInstitucion, $datos-> idLocalidad, $datos-> responsableInstitucion, $datos-> domicilioInstitucion)) {
                    http_response_code(200);
                } else {
                    http_response_code(400);
                }
            } else {
                http_response_code(405);
            }
            
            break;

        default:
            break;
    }

?>