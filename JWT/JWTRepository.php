<?php

require_once "vendor/autoload.php";
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;

Dotenv\Dotenv::createImmutable(__DIR__ . "/../")->load();
class JwtUser{
    
        private ?string $Token;
        private ?string $alg = "HS256";


        public function __construct(?int $userID){
            $this ->Token = $this->createJwtUser($userID);
        }

        private function createJwtUser($data):string{
            $time = time();
            $payload = array(
                "iat" => $time,
                "exp" => $time + (60*60*24*7),
                "data" => $data
            );
            $token = JWT::encode($payload, $_ENV["SECRET_JWT"], $this->alg);
            return $token;
        }

        function getJwtUser():string{
            return $this->  Token;
        }



        static public function decodeJwt($token){
            try {
                $dataUser = JWT::decode($token, new Key($_ENV["SECRET_JWT"], "HS256"));
                return $dataUser->data;
            } catch (SignatureInvalidException $e) {
                return "error al verificar la firma del token";

                // provided JWT signature verification failed.
            } catch (BeforeValidException $e) {
                return "error al usar el token antes de su fecha de creación";

                // provided JWT is trying to be used before "nbf" claim OR
                // provided JWT is trying to be used before "iat" claim.
            } catch (ExpiredException $e) {
                return "error al usar el token despues de su fecha de expiración";

                // provided JWT is trying to be used after "exp" claim.
            } catch (UnexpectedValueException $e) {
                return "token mal creado";

                // provided JWT is malformed OR
                // provided JWT is missing an algorithm / using an unsupported algorithm OR
                // provided JWT algorithm does not match provided key OR
                // provided key ID in key/key-array is empty or invalid.
            }

            
        }        

    }

?>