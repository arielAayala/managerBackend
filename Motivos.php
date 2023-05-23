<?php

include_once "models/motivosClass.php";
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST");
header("Content-Type: JSON");

switch($_SERVER["REQUEST_METHOD"]){
    case 'GET':
        echo json_encode(Motivos::getAll());
        break;
    }
?>