<!--page de recherche de patients, plusieurs filtres proposés-->

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>TP2 / API</title>
    <meta name="description" content="Alexis Escudero / Aurelien Vallet">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Sonsie+One" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="./src/bibliotheques/bootstrap.min.css">
    <script src="./src/bibliotheques/jquery.slim.min.js"> </script>
    <link rel="stylesheet" href="./src/cssJs/style.css">
    <script src="./src/bibliotheques/ajax.js"> </script>
    <script src="./src/cssJs/index.js"> </script>


</head>

<body>
    <div class="container-fluid">
        <header>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                    <h1> API </h1>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                    <a href="documentation.php"> documentation </a>
                    <a href="index.php"> details API </a>
                </div>
            </div>


        </header>
        <main>
            <h1> documentation </h1>
            <p> L’objectif de ce API REST permettant à un utilisateur d’envoyer des données dans une base de données MySQL relatives à la navigation d’un utilisateur sur un site web</p>
            <p> Ci-dessous vous trouverez la liste de fonctionnalités offerte par l’application ainsi que les paramètres à envoyer ainsi que le header et les réponses en retour</p>

 
            <table class="tftable" border="1">
                <tr>
                    <th> Route </th>
                    <th> Méthode </th>
                    <th>Description</th>
                    <th> HEADER </th>
                    <th> Paramètre 5</th>
                    <th> Réponse </th>
                </tr>
                <tr>
                    <td>http://127.0.0.1/api.php?call=getpageana&{id}</td>
                    <td> GET </td>
                    <td> Obtenir le détail d’une transaction en fonction de son ID (table concerné “PAGEANA”). </td>
                    <td> token </td>
                    <td> id = string
                        call = {getpageana}
                    </td>
                    <td> { “token : Mot de passe / login incorrect” }
                        { “token: zdkdkdkkd…..” }
                    </td>
                </tr>
                <tr>
                    <td> http://127.0.0.1/api/api.php?call=getToken</td>
                    <td> GET </td>
                    <td> Tester la validité d’un token. </td>
                    <td> token </td>
                    <td> call=getToken </td>
                    <td> {"status_signature":"signature valide","status_expiration":"token toujours valide"}</td>
                </tr>
                <tr>
                    <td>http://127.0.0.1/api/?call=getpageana</td>
                    <td> GET </td>
                    <td> Récupérer tous les détails de toutes les transactions ( table concerné “PAGEANA”). </td>
                    <td> token </td>
                    <td> call=getpageana</td>
                    <td> [{"id_pageana":"32","ip":"4 ","id_utilisateur":"4","url":"4","code_ecran":"1","code_action":"1","libelle_action":"4", ...</td>
                </tr>
                <tr>
                    <td> http://127.0.0.1/api/?call=deletepageana&id={id}</td>
                    <td> DELETE </td>
                    <td> Supprime une transaction par son l’id ( table concerné “PAGEANA”). </td>
                    <td>token </td>
                    <td> call=deletepageana
                        id = {string}
                    </td>
                    <td> { “Token de l'utilisateur : zdkdkdkkd…..” }</td>
                </tr>
                <tr>
                    <td> http://127.0.0.1/api/?call=inscriptionUser</td>
                    <td> POST </td>
                    <td> Inscription d’un utilisateur (ajouts d'éléments dans la table Utilisateur).</td>
                    <td> </td>
                    <td>nom = {string}
                        password = {string}
                        call = inscriptionUser
                    </td>
                    <td> { “resultat : Utilisateur Ajouter “}
                        { “resultat :resultat : Utilisateur Ajouter “ } </td>
                </tr>
                <tr>
                    <td> http://127.0.0.1/api/?call=ConnectionUser </td>
                    <td>POST</td>
                    <td> Connection d’un utilisateur (vérifie les éléments de connexion et retourne un Token si il sont correct)..</td>
                    <td> </td>
                    <td> nom = {string}
                        password = {string}
                        call= ConnectionUser
                    </td>
                    <td>{"status_signature":"signature valide","status_expiration":"token toujours valide"}</td>
                </tr>
                <tr>
                    <td> http://127.0.0.1/api/?call=insertpageana </td>
                    <td> PUT </td>
                    <td> Insertion d'une transaction (table concerné “PAGEANA” ).</td>
                    <td>token </td>
                    <td> ip = {integer}
                        id_utilisateur = {integer}
                        url = {string}
                        lebelle_action = {integer}
                        call = insertpageana
                    </td>
                    <td> {"status":"Ajout dans la table pageana avec succes"}</td>
                </tr>
            </table>


        </main>
    </div>
</body>

</html>