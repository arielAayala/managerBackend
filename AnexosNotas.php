<?php
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH");
    header("Content-Type: JSON");
    include_once "models/AnexosNotasClass.php";

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            if (isset($_GET["idNota"]) && isset($_FILES["file"])) {
                $dir = "notasAnexos";
                $nameFile = $_GET["idNota"] . "-" . $_FILES["file"]["name"];
                $urlFile = $dir . "/" . $nameFile;
        
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $urlFile)) {
                    if (AnexosNotas::insert($_FILES["file"]["name"],$_GET["idNota"], $urlFile)) {
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