<?php

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, PUT");
header("Content-Type: JSON");
include_once "models/PsicopedagogosClass.php";

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        if(isset($_GET["idPsicopedagogo"])){
            echo json_encode(Psicopedagogos::getById($_GET["idPsicopedagogo"]));
        }else{
            echo json_encode(Psicopedagogos::getAll());
        }
        break;
    
    case 'POST':
        $datos = json_decode(file_get_contents("php://input"));
        if($datos){
            if (Psicopedagogos::insert($datos -> nombrePsicopedagogo, $datos-> dniPsicopedagogo, $datos -> nacimientoPsicopedagogo)) {
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
            if(Psicopedagogos::update($_GET["idPsicopedagogo"], $datos->nombrePsicopedagogo, $datos->dniPsicopedagogo,$datos->nacimientoPsicopedagogo)){
                http_response_code(200);
            }else{
                http_response_code(405);
            }
        }
        break; 

    default:
        # code...
        break;
}

?>