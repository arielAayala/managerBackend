<?php
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
            if($datos != NULL){
                if (Encargos::insert($datos->idTipo, $datos->idEstado, $datos->idUsuarioCreador, $datos->idUsuarioResponsable, $datos->idInstitucion, $datos->fechaCreacionEncargo, $datos->fechaCierreEncargo, $datos->descripcionEncargo)) {
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