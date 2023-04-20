<?php

    include_once "models/NotasClass.php";

    switch ($_SERVER["REQUEST_METHOD"]) {

        case 'GET':
            header("Content-Type: JSON");
            if (isset($_GET["idEncargo"])){
                echo json_encode(Notas::getByIdEncargo($_GET["idEncargo"]));
            }
            break;

        case 'POST':
            $datos = json_decode(file_get_contents("php://input"));
            if($datos){
                if(Notas::insert($datos-> idEncargo ,$datos-> idUsuarioCreador, $datos-> idNuevoResponsable, $datos-> fechaCreacionNota, $datos-> comentarioNota)){
                    http_response_code(200);
                }else{
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