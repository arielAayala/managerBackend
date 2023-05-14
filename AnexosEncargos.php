<?php

    include_once "models/AnexosEncargosClass.php";

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'GET':
            header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Content-Type: JSON");
            header("Content-Type: JSON");
            if (isset($_GET["idEncargo"])){
                echo json_encode(Anexos::getByIdEncargo($_GET["idEncargo"]));
            }
            break;

        case 'POST':
            $datos = json_decode(file_get_contents("php://input"));
            if ($datos) {
                if (Anexos::insert($datos-> idEncargo, $datos-> idNota, $datos-> urlAnexo)) {
                    http_response_code(200);
                } else {
                    http_response_code(400);
                }
                
            }else{
                http_response_code(405);
            }
            break;
        
        default:
            # code...
            break;
    }

?>