<?php
    require_once "models/EncargosClass.php";
    
    switch($_SERVER["REQUEST_METHOD"]){
        case 'GET':
            header("Content-Type: JSON");
            if (isset($_GET["idEncargo"])){
                echo json_encode(Encargos::getById($_GET["idEncargo"]));
            }else{
                echo json_encode(Encargos::getAll());
            }
            break;

        case 'POST':
            $datos = json_decode(file_get_contents("php://input"));
            if($datos){
                if (Encargos::insert($datos->idTipo, $datos->idEstado, $datos->idUsuarioCreador, $datos->idUsuarioResponsable, $datos->idInstitucion, $datos->fechaCreacionEncargo, $datos->descripcionEncargo)) {
                    http_response_code(200);
                }else{
                    http_response_code(400);
                }
            }else{
                http_response_code(405);
            }
            break;

        case 'DELETE':
            if (Encargos::delete($_GET["idEncargo"])) {
                http_response_code(200);
            } else {
                http_response_code(400);
            }
            
            break;

        case 'PUT':
            $datos = json_decode(file_get_contents("php://input"));
            if($datos){
                if (Encargos::update($_GET["idEncargo"],$datos->idTipo, $datos->idEstado, $datos->idUsuarioResponsable, $datos->idInstitucion, $datos -> fechaCierreEncargo, $datos->descripcionEncargo)) {
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