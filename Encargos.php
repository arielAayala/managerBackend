<?php
    require_once "models/EncargosClass.php";
    
    switch($_SERVER["REQUEST_METHOD"]){
        case 'GET':
            header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Content-Type: JSON");
            if (isset($_GET["idEncargo"])){
                echo json_encode(Encargos::getById($_GET["idEncargo"]));
            }else{
                echo json_encode(Encargos::getAll());
            }
            break;

        case 'POST':
            header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            header("Content-Type: JSON");
            $datos = json_decode(file_get_contents("php://input"));
            if($datos){
                if (Encargos::insert($datos->tituloEncargo,$datos->idTipo, $datos->idEstado, $datos->idUsuarioCreador, $datos->idUsuarioResponsable, $datos->idInstitucion, $datos->fechaCreacionEncargo, $datos->descripcionEncargo)) {
                    http_response_code(200);
                }else{
                    http_response_code(400);
                }
            }else{
                http_response_code(405);
            }
            break;

        case 'PUT':
            header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Access-Control-Allow-Methods: GET, POST, PUT");
            header("Access-Control-Allow-Headers: Content-Type");
            header("Content-Type: application/json");
            $datos = json_decode(file_get_contents("php://input"));
            if($datos){
                if (Encargos::update($_GET["idEncargo"], $datos->tituloEncargo,$datos->idTipo, $datos->idEstado, $datos->idUsuarioResponsable, $datos->idInstitucion,  $datos->descripcionEncargo)) {
                    http_response_code(200);
                }else{
                    http_response_code(400);
                }
            }else{
                http_response_code(405);
            }
            break;   
    }

?>