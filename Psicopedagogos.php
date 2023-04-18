<?php

include_once "models/PsicopedagogosClass.php";

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        header("Content-Type: JSON");
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

    case 'DELETE':
        if (Psicopedagogos::delete($_GET["idPsicopedagogo"])) {
            http_response_code(200);
        } else {
            http_response_code(400);
        } 

    default:
        # code...
        break;
}

?>