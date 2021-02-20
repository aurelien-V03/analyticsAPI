<?php
// La classe db_connection assure une connection avec la base de donnée
// MySQL, elle permet également de réaliser des opérations comme récupérer
// des données et en poster.
class db_connection {

    private $mysql_connection; // objet PDO
    private $user = "root";
    private $pass = "";
    private $host = "localhost";
    private $dbname = "analytics_api";

    // Constructeur 
    public function __construct() {
        // Connection bdd 
        try {
            $this->mysql_connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8', $this->user, $this->pass);
        } catch (Exception $e) {
            die('Erreur connexion MySQL : ' . $e->getMessage());  //On définit le mode d'erreur de PDO sur Exception
        }
    }


    // Récupère toutes les occurrences de la table “pageana”
    // et affiche le JSON des occurrences 
    public function getPageana(){
        $request = "SELECT id_pageana, ip, id_utilisateur, url, code_ecran, code_action, libelle_action, date_enreg FROM pageana";
        $responseJson = array();
        $request_prepared = $this->mysql_connection->prepare($request);
        $request_prepared->execute();

        while ($request_row = $request_prepared->fetch()) {
            $currentRowArray = array('id_pageana' => $request_row["id_pageana"], 'ip' => $request_row['ip'], 'id_utilisateur' => $request_row["id_utilisateur"], 'url' => $request_row["url"], 'code_ecran' => $request_row["code_ecran"], 'code_action' => $request_row["code_action"], 'libelle_action' => $request_row["libelle_action"],'date_enreg' => $request_row["date_enreg"]);
            array_push($responseJson, $currentRowArray);        }
        $this->affichageJson($responseJson);
    }

    // Récupère l'occurrences de la table “pageana” avec $id
    // et affiche le JSON de cette occurrence
    public function getPageanaById($id)  {
        $request = "SELECT id_pageana, ip, id_utilisateur, url, code_ecran, code_action, libelle_action, date_enreg FROM pageana WHERE id_pageana = ?";
            $responseJson = array();
            $request_prepared = $this->mysql_connection->prepare($request);
            $request_prepared->execute(array($id));

            // select 1 ligne 
            if($request_prepared->rowCount() > 0){
                $request_row = $request_prepared->fetch();
                $responseJson = array('id_pageana' => $request_row["id_pageana"], 'ip' => $request_row['ip'], 'id_utilisateur' => $request_row["id_utilisateur"], 'url' => $request_row["url"], 'code_ecran' => $request_row["code_ecran"], 'code_action' => $request_row["code_action"], 'libelle_action' => $request_row["libelle_action"],'date_enreg' => $request_row["date_enreg"]);    
            }
            // select 0 ligne (donc aucun resultat)
            else{
                $responseJson = array('status' => 'numero pageana inconnu');
            }
        $this->affichageJson($responseJson);
    }

    // ajoute une occurrence dans la table pageana
    public function postPageana($ip, $id_utilisateur, $url, $code_ecran, $code_action, $libelle_action) {
        $request = "INSERT INTO pageana(ip,id_utilisateur,url,code_ecran,code_action,libelle_action,date_enreg) VALUES(?,?,?,?,?,?,?)";
        $request_prepared = $this->mysql_connection->prepare($request);

        // Si la requete a été executée avec succes 
        if ($request_prepared->execute(array($ip, $id_utilisateur, $url, $code_ecran, $code_action, $libelle_action, date("j/ n/ Y")))) {
            $responseJson =  array(  'status' => 'Ajout dans la table pageana avec succes'    );
        }
        // Si la requete n'a pas pu etre executée
        else {
            $responseJson =  array( 'status' => 'Erreur lors de l\'ajout dans la table pageana'   );
        }
        $this->affichageJson($responseJson);
    }

    // supprime une occurrence dans la table pageana
    public function deletePageana($id) {
        $request = "delete from pageana where id_pageana = ?";
        $request_prepared = $this->mysql_connection->prepare($request);

        if ($request_prepared->execute(array($id))) {
            if($request_prepared->rowCount() > 0)
                 $responseJson =  array('status' => 'Suppression dans la table pageana avec succes');
            else
                $responseJson =  array('status' => 'Aucune occurrence dans la table ne possède cet id ');
                } else {
            $responseJson =  array('status' => 'Erreur lors de l\'execution de la requete');
        }
        $this->affichageJson($responseJson);
    }


    // affichage du json
    private function affichageJson($responseJson) {
        header('Content-Type: application/json');
        echo json_encode($responseJson, JSON_PRETTY_PRINT);
    }


    // On vérifie si le token envoyer par le client existe bien en bdd
    public function verificationToken($token){
        $request_prepared = $this->mysql_connection->prepare("Select token from user where token = ?");
        if ($request_prepared->execute(array($token))) { return $request_prepared;    } 
        return false;
    }


    // On souhaite ajouter une utilisateur en BDD. On verifie dabord si il nexiste pas déja grace à son nom.
    // Si il n'existe pas on l'ajoutes alors
    public function inscriptionsUtilisateur($nom, $password){
        $resultat = " Utilisateur déja existant. ";
        if(! $this->compteExistant($nom) ) {
            $request_prepared = $this->mysql_connection->prepare("INSERT INTO user(nom, password)  VALUES(?,?)");
            if ($request_prepared->execute(array($nom, $password ) )) { 
                $resultat = " Utilisateur Ajouter. ";
            } 
        }  
         $this->affichageJson( $resultat ); 
    }

    // Création d'un token utilisateur
    public function creationTokenUtilisateur( $nom, $password ) {
        include_once('../tokenJwt.php');
        $token = new TokenService;
        $this->affichageJson($token->generatejwtToken($nom, $password )) ;
    }


    // Grace au nom passer en paramètre on vérifie si il n'existe pas déja en bdd.
    public function compteExistant($nom){
        $request_prepared = $this->mysql_connection->prepare("SELECT count(nom) from user where nom = '$nom' ");
        if ($request_prepared->execute( )) { 
            $request_row = $request_prepared->fetch();
            if( $request_row[0] > 0 ){ return true; }
        } 
        return false;
    }

    // On vérifie si le mot de pass et le nom utilisateur renseigner sont correcte.
    public function verificationConnectionUtilisateur( $nom, $password ){
        $request_prepared = $this->mysql_connection->prepare("SELECT count(nom) from user where nom = '$nom' and password ='$password' ");
        if ($request_prepared->execute( )) { 
            $request_row = $request_prepared->fetch();
            if( $request_row[0] > 0 )
                $this->creationTokenUtilisateur( $nom, $password );
            else
                 $this->affichageJson(array("Mot de passe / login incorrect"));
        } 
        else{
            $this->affichageJson("Probleme dans execution de la requete connection utilisateur");
        }
    }
 

    

}


