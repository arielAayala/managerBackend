<?php
    include_once "models/UsersLoginRepository.php";
    include_once "JWT/JWTRepository.php";
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Credentials: true");

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':

            $datos = json_decode(file_get_contents("php://input"));
            if ($datos){
                if ($userData = UsersLogin::Login($datos->correoUsuario, $datos->contrasenaUsuario)) {
                    http_response_code(200);

                    $cookiesConfiguration = [
                        'expires' => (time() + (60*60*24*7)), 
                        'path' => '/', 
                        'domain' => '', // leading dot for compatibility or use subdomain
                        'secure' => true,     // or false
                        'httponly' => true,    // or false
                        'samesite' => 'None' // None || Lax  || Strict
                    ];

                    $token = new JwtUser($userData[0]["idUsuario"]);
                    setcookie('Token', $token ->getJwtUser() , $cookiesConfiguration);
                    echo json_encode($userData[0]);

                } else {
                    http_response_code(404);
                    echo json_encode(["Error" => "Usuario no encontrado"]);
                } 
            }else{
                http_response_code(400);
                echo json_encode(["Error" => "Ausencia de datos requeridos"]);
            } 
            break;

        case 'GET':
            if ( isset($_COOKIE['Token']) ) {        
                $decodeUser = JwtUser::decodeJwt($_COOKIE["Token"]);
                if ($userData = UsersLogin::GetUserData($decodeUser)) {
                    echo json_encode($userData[0]);
                }else {
                    http_response_code(404);
                    echo json_encode(["Error" => "Usuario no encontrado"]);
                }     
            }else{
                http_response_code(400);
                echo json_encode(["Error" => "Token no creado"]);
            }

        default:
            # code...
            break;
    }
?>