<?php

    include_once "models/ContactoClass.php";

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'GET':
            header("Content-Type: JSON");
            if (isset($_GET["idPsicopedagogo"])){
                echo json_encode(Contactos::getByIdPsicopedagogo($_GET["idPsicopedagogo"]));
            }
            break;

        default:
            # code...
            break;
    }

?>