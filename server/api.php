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

function jsonRetour( $valeurRetour) {
    header('Content-Type: application/json');
    echo json_encode( $valeurRetour, JSON_PRETTY_PRINT);
}



switch($request_method) {

    case 'GET':
        // Obtenir une transaction selon l'id
        if (isset($_GET['id']) &&  $_GET['call'] == 'getpageana'  ) {
            if ( $token->tokenValid($numeroToken) == false ) {  jsonRetour(  array(" code :" => "Erreur avec le Token")) ;  break;}
            $mysql_connection->getPageanaById($_GET['id']); break;
        }

        // Obtenir toutes les transactions
        if ($_GET['call'] == 'getpageana' ) {
            if ( $token->tokenValid($numeroToken) == false ) {  jsonRetour(  array(" code :"  =>"Erreur avec le Token")) ;  break;}
            $mysql_connection->getPageana(); break;
        }

        // Tester la validité du token de l'utilisateur
        if ($_GET['call'] == 'getToken') {
            $result = $token->testValiditeToken( $numeroToken);
            jsonRetour( $result );
            break;
        }

     case 'DELETE': 
        // Suppresion d'une transaction
        if ($_GET['call'] == 'deletepageana' && isset($_GET['id'])  ) {
            if ( $token->tokenValid($numeroToken) == false ) {  jsonRetour(  array(" code :"  => "Erreur avec le Token")) ;  break;}
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
        if ( isset($_PUT['ip']) && isset($_PUT['id_utilisateur']) && isset($_PUT['url'])  && isset($_PUT['libelle_action']) && $_PUT['call'] == 'insertpageana'  ) {
            if ( $token->tokenValid($numeroToken) == false ) {  jsonRetour(  array(" code :"  => "Erreur avec le Token")) ;  break;}
            $mysql_connection->postPageana( $_PUT['ip'] , $_PUT['id_utilisateur'], $_PUT['url'], $_PUT['code_ecran'] ,  $_PUT['code_action'], $_PUT['libelle_action']);  
        }
        break;
    
           
    // Requête invalide
    default:
        jsonRetour( " Erreur Requête. " );
        break;
}

