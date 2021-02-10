<?php
    // La classe db_connection assure une connection avec la base de donnée
    // MySQL, elle permet également de réaliser des opérations comme récupérer
    // des données et en poster.
    class db_connection{

        public $mysql_connection;

        // Constructeur 
        function __construct(){
            try{
                $user = "root";
                $pass = "";
                $this->mysql_connection = new PDO('mysql:host=localhost;dbname=analytics_api;charset=utf8', $user, $pass);
                }
                catch(Exception $e)
                {
                 die('Erreur connexion MySQL : ' . $e->getMessage());
                }
        }


    }



?>