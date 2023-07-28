<?php
    
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods:  POST");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Credentials: true");

    switch ($_SERVER["REQUEST_METHOD"]) {
        case 'POST':
            $cookiesConfiguration = [
                'expires' => (time() + -3600), 
                'path' => '/', 
                'domain' => '', // leading dot for compatibility or use subdomain
                'secure' => true,     // or false
                'httponly' => true,    // or false
                'samesite' => 'None' // None || Lax  || Strict
            ];
            setcookie('Token', "" , $cookiesConfiguration);
                    
        default:
            # code...
            break;
    }
?>

