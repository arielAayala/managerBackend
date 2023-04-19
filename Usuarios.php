<?php

    include_once "models/UsuariosClass.php";

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'GET':
            header("Content-Type: JSON");
            if (isset($_GET["correoUsuario"],$_GET["contrasenaUsuario"])){
                echo json_decode(Usuarios::login($_GET["correoUsuario"],$_GET["contrasenaUsuario"]));
            }else{
                echo json_encode(Usuarios::getAll());
            }
            break;
        
        default:
            # code...
            break;
    }
?>