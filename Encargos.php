<?php
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH");
    header("Content-Type: JSON");
    require_once "models/EncargosClass.php";
    
    switch($_SERVER["REQUEST_METHOD"]){
        case 'GET':
            if (isset($_GET["idEncargo"])){
                echo json_encode(Encargos::getById($_GET["idEncargo"]));
            }else{
                echo json_encode(Encargos::getAll());
            }
            break;

        case 'POST':

            $datos = json_decode(file_get_contents("php://input"));
            if($datos){
                if (Encargos::insert($datos->tituloEncargo, $datos->idTipo, $datos->idMotivo, $datos->idUsuarioCreador, $datos->idUsuarioResponsable, $datos->idInstitucion, $datos->descripcionEncargo)) {
                    http_response_code(200);
                }else{
                    http_response_code(400);
                }
            }else{
                http_response_code(405);
            }
            break;

        case 'PUT':
            $datos = json_decode(file_get_contents("php://input"));
            if($datos){
                if (Encargos::update($_GET["idEncargo"], $datos->tituloEncargo,$datos->idTipo, $datos->idEstado, $datos->idUsuarioResponsable, $datos->idInstitucion,  $datos->descripcionEncargo, $datos-> idMotivo )) {
                    http_response_code(200);
                }else{
                    http_response_code(400);
                }
            }else{
                http_response_code(405);
            }
            break;
            
        case 'PATCH':
            $datos = json_decode(file_get_contents("php://input"));
            if($datos){
                if (Encargos::patch($_GET["idEncargo"], $datos->idUsuarioResponsable)) {
                    http_response_code(200);
                } else {
                    http_response_code(400);
                }
                
            }else{
                http_response_code(405);
            }
            break;
    }

?>