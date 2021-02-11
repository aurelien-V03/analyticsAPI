<?php 

    // https://dev.to/robdwaller/how-to-create-a-json-web-token-using-php-3gml

    // Fonction qui prend en parametre le nom d'un user et son mot de passe
    // et genere un JWT en prenant en compte la clé secrete
    // et cree un token JWT 
    function generatejwtToken($userName,$userPassword,$secretKey){
        // Create token header as a JSON string
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        // Create token payload as a JSON string
        $payload = json_encode(['user_name' => $userName, 'user_password' => $userPassword]);

        // Encode Header to Base64Url String
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secretKey, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }

    // fonction qui permet de verifier si un JWT token est valide
    // retourne true si le token est valide, false sinon
    function checkjwtToken($jwt,$secretKey){
        $jwt_is_valid = false;

        $jwt_array = explode('.',$jwt); // Array qui contient la structure du token ( [0] = header / [1] = payload / [2] = signature)
        var_dump($jwt_array);
        $jwt_decode_header = base64_decode($jwt_array[0]);
        $jwt_decode_payload = base64_decode($jwt_array[1]);

        // Encode Header to Base64Url String
        $base64UrlHeader_check = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwt_decode_header));

        // Encode Payload to Base64Url String
        $base64UrlPayload_check = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwt_decode_payload));

        $signature_toCheck = hash_hmac('sha256', $base64UrlHeader_check . "." . $base64UrlPayload_check, $secretKey, true);

        $base64UrlSignature_tocheck = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature_toCheck));

        // Si la signature générée correspond à celle envoyée 
        if($base64UrlSignature_tocheck === $jwt_array[2])
            $jwt_is_valid = true;

        return $jwt_is_valid;
    }

    /*
    EXEMPLE DE CODE 

    $secretKey = "123";
    $jwtToken = generatejwtToken('bob12','motdePasse12',$secretKey);
    
    echo $jwtToken . "</br>";

    $jwtValide = checkjwtToken($jwtToken,$secretKey);

    if($jwtValide)
        echo 'valide';
    else 
        echo "not valide";
    
    
    */



?>