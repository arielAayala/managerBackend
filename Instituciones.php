<?php

    include_once "models/InstitucionesClass.php";

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'GET':
            header("Content-Type: JSON");
            json_encode(Instituciones::getAll());
            break;
        
        case 'POST':
            $datos = json_decode(file_get_contents("php://input"));
            if ($datos) {
                if (Instituciones::insert($datos-> nombreInstitucion, $datos-> idLocalidad, $datos-> nombreResponsableInstitucion, $datos-> domicilioInstitucion)) {
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