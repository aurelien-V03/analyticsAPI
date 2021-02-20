<?php 

class Token {

    private $secretKey = 1846857485489451;


    public function __construct() {
       
    }


    // Fonction Générant un token avec le nom et password d'un utilsiateur et une cle secrete
    public function generatejwtToken($userName,$userPassword){
        // Create token header as a JSON string
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        // Create token payload as a JSON string
        $date = new DateTime();
        $token_date_creation =  $date->getTimestamp();
        $token_date_expiration = $token_date_creation + 5;
        $payload = json_encode(['user_name' => $userName, 'user_password' => $userPassword, 'iat' => $token_date_creation, 'exp' => $token_date_expiration]);

        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $this->secretKey, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }


    // fonction qui permet de verifier si un JWT token est valide (signature cohérente)
    // @jwt : le token a verifier
    public function checkjwtToken($jwt){
        $jwt_is_valid = false;

        $jwt_array = explode('.',$jwt); // Array qui contient la structure du token ( [0] = header / [1] = payload / [2] = signature)
        $jwt_decode_header = base64_decode($jwt_array[0]);
        $jwt_decode_payload = base64_decode($jwt_array[1]);

        // Encode Header to Base64Url String
        $base64UrlHeader_check = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwt_decode_header));

        // Encode Payload to Base64Url String
        $base64UrlPayload_check = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwt_decode_payload));

        $signature_toCheck = hash_hmac('sha256', $base64UrlHeader_check . "." . $base64UrlPayload_check, $this->secretKey, true);

        $base64UrlSignature_tocheck = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature_toCheck));

        // Si la signature générée correspond à celle envoyée 
        if($base64UrlSignature_tocheck === $jwt_array[2])
            $jwt_is_valid = true;

        return $jwt_is_valid;
    }

    // Fonction qui permet de savoir si un token est encore valide en fonctin de sa date d'expiration
    // @token : le token à verifier
    public function checkjwtTokenExpirationDate($token){
       
        $jwt_array = explode('.',$token); // Array qui contient la structure du token ( [0] = header / [1] = payload / [2] = signature)
        $jwt_decode_payload = base64_decode($jwt_array[1]);
        $array_payload =json_decode( $jwt_decode_payload);
        $expiration_date =  $array_payload->{'exp'};

        // date actuelle 
        $date = new DateTime();

        if($expiration_date > $date->getTimestamp())
            return true;
        else
            return false;
    }

    public function tokenValid($token){
        return $this->checkjwtTokenExpirationDate($token) && $this->checkjwtToken($token);
    }
  
}


?>