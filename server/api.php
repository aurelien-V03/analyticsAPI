<?php
include_once('db_connect.php');
include_once('../tokenJwt.php');

$mysql_connection = new db_connection();
$token = new TokenService();

// récupère la méthode de la requète (Get, Post, ...)
$request_method = $_SERVER["REQUEST_METHOD"];

// Récuperation tu token de l'utilisateur passer par l'entête de la requète
$headerHTTP =  apache_request_headers();
$numeroToken = $headerHTTP['Authorization'];

switch($request_method) {
    case 'GET':
        // Obtenir une transaction selon l'id
        if (isset($_GET['id']) &&  $_GET['call'] == 'getpageana' && $token->tokenValid($numeroToken )) {
            $mysql_connection->getPageanaById($_GET['id']); break;
        }

        // Obtenir toutes les transactions
        if ($_GET['call'] == 'getpageana' && $token->tokenValid($numeroToken)) {
            $mysql_connection->getPageana(); break;
        }

        // Tester la validité du token de l'utilisateur
        if ($_GET['call'] == 'getToken') {
            $tokenSignatureValid =  $token->checkjwtTokenSignature( $numeroToken );
            $tokenStillValid = $token->checkjwtTokenExpirationDate($numeroToken);
           
            $tokenSignatureStatus = $tokenSignatureValid ? "signature valide" : "signature incorrecte";
            $tokenExpirationStatus = $tokenStillValid ? "token toujours valide" : "token perime";

            $result = array("status_signature" => $tokenSignatureStatus, 'status_expiration' => $tokenExpirationStatus);

            header('Content-Type: application/json');
            echo json_encode($result, JSON_PRETTY_PRINT);
            break;
        }

     case 'DELETE': 
        // Suppresion d'une transaction
        if ($_GET['call'] == 'deletepageana' && isset($_GET['id']) && $token->tokenValid($numeroToken) ) {
            $mysql_connection->deletePageana( $_GET['id'] );  break;
        }

    case 'POST': 
        // Inscriptions utilisateur
        if (  isset($_POST['nom'])  && isset($_POST['password'])  && $_POST['call'] == 'inscriptionUser' ) {
           $mysql_connection->inscriptionsUtilisateur( $_POST['nom'], $_POST['password'] ); break;
        }
        // Connection utilisateur
        if (  isset($_POST['nom']) && isset($_POST['password'])   && $_POST['call'] == 'ConnectionUser') {
            $mysql_connection->verificationConnectionUtilisateur( $_POST['nom'], $_POST['password'] ); break;
         }

    case 'PUT': 
        //tableau qui va contenir les données reçues
        $_PUT = array(); 
        parse_str(file_get_contents('php://input'), $_PUT);

        // Insertion d'une pageana
        if (  $token->tokenValid( $numeroToken ) && isset($_PUT['ip']) && isset($_PUT['id_utilisateur']) && isset($_PUT['url'])  && isset($_PUT['libelle_action']) && $_PUT['call'] == 'insertpageana'  ) {
           $mysql_connection->postPageana( $_PUT['ip'] , $_PUT['id_utilisateur'], $_PUT['url'], 1, 1, $_PUT['libelle_action']);  
        }
        break;
    
           
    // Requête invalide
    default:
        header('Content-Type: application/json');
        echo json_encode(" Erreur Requête. ", JSON_PRETTY_PRINT);
        break;
}

