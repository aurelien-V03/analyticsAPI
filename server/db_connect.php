<?php
    // La classe db_connection assure une connection avec la base de donnée
    // MySQL, elle permet également de réaliser des opérations comme récupérer
    // des données et en poster.
    class db_connection{

        public $mysql_connection; // objet PDO

        // Constructeur 
        function __construct(){
            try{
                $user = "root";
                $pass = "";
                $host = "localhost";
                $dbname = "analytics_api";

                $this->mysql_connection = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);
               
            }
                catch(Exception $e)
                {
                    die('Erreur connexion MySQL : ' . $e->getMessage());
                }
        }

        // Récupère toutes les occurrences de la table “pageana”
        // et affiche le JSON des occurrences 
        function getPageana(){
            $request = "SELECT id_pageana, ip, id_utilisateur, url, code_ecran, code_action, libelle_action, date_enreg FROM pageana";
            $responseJson = array();
            $request_prepared = $this->mysql_connection->prepare($request);
            $request_prepared->execute();

            while($request_row = $request_prepared->fetch()){
                array_push($responseJson, $request_row);
            }
            header('Content-Type: application/json');
            echo json_encode($responseJson, JSON_PRETTY_PRINT);
        }   

        // Récupère l'occurrences de la table “pageana” avec $id
        // et affiche le JSON de cette occurrence
        function getPageanaById($id){
            $request = "SELECT id_pageana, ip, id_utilisateur, url, code_ecran, code_action, libelle_action, date_enreg FROM pageana WHERE id_pageana = ?";
            $responseJson = array();
            $request_prepared = $this->mysql_connection->prepare($request);
            $request_prepared->execute(array($id));

            $request_row = $request_prepared->fetch();
            array_push($responseJson, $request_row);

            header('Content-Type: application/json');
            echo json_encode($responseJson, JSON_PRETTY_PRINT);
        }

        // ajoute une occurrence dans la table pageana
        function postPageana($ip, $id_utilisateur,$url, $code_ecran, $code_action, $libelle_action, $date){
            $request = "INSERT INTO pageana(ip,id_utilisateur,url,code_ecran,code_action,libelle_action,date_enreg) VALUES(?,?,?,?,?,?,?)";
            $reponseJson = array();
            $request_prepared = $this->mysql_connection->prepare($request);

            // Si la requete a été executée avec succes 
            if($request_prepared->execute(array($ip,$id_utilisateur,$url,$code_ecran,$code_action,$libelle_action,$date)))
            {
                $responseJson =  array(
                    'status' => 'Ajout dans la table pageana avec succes'
                );
            }
            // Si la requete n'a pas pu etre executée
            else{
                $responseJson =  array(
                    'status' => 'Erreur lors de l\'ajout dans la table pageana'
                );
            }
            header('Content-Type: application/json');
            echo json_encode($responseJson, JSON_PRETTY_PRINT);
         


        }

        // supprime une occurrence dans la table pageana
        function deletePageana($id){
            $request = "delete from pageana where id_pageana = ?";
            $reponseJson = array();
            $request_prepared = $this->mysql_connection->prepare($request);

            if($request_prepared->execute(array($id))){
                $responseJson =  array(
                    'status' => 'Suppression dans la table pageana avec succes'
                );
            }
            else{
                $responseJson =  array(
                    'status' => 'Erreur lors de la suppression dans la table pageana echec'
                );
            }

            header('Content-Type: application/json');
            echo json_encode($responseJson, JSON_PRETTY_PRINT);

        }

    }



?>