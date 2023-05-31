<?php

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH");
header("Content-Type: JSON");
    include_once "models/AnexosEncargosClass.php";

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'GET':
            if (isset($_GET["idEncargo"])){
                echo json_encode(EncargosAnexos::getByIdEncargo($_GET["idEncargo"]));
            }
            break;

        case 'POST':
            if (isset($_GET["idEncargo"]) && isset($_FILES["file"])) {
                $dir = "encargosAnexos";
                $nameFile = $_GET["idEncargo"] . "-" . $_FILES["file"]["name"];
                $urlFile = $dir . "/" . $nameFile;
        
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $urlFile)) {
                    if (EncargosAnexos::insert($_FILES["file"]["name"],$_GET["idEncargo"], $urlFile)) {
                        http_response_code(200);
                    } else {
                        http_response_code(400);
                    }
                } else {
                    http_response_code(400);
                }
            } else {
                http_response_code(400);
            }
            echo $_FILES['file']['error'];
            break;
        
        default:
            # code...
            break;
    }

?>