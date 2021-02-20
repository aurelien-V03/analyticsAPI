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
          <h1 style="color:white;"> API </h1>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
          <a href="documentation.php"> documentation </a>
          <a href="index.php"> details API </a>
        </div>
      </div>

    </header>
    <main>
      <!-- Formulaire d'inscriptions pour obtenir un token  -->



      <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
          <h2> Inscriptions utilisateur : </h2>
          
            <div class="row">
              <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                <label >Nom :</label>
                <input class="form-control"  type="text" id='nomInsription'>
              </div>

              <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                <label >Password :</label>
                <input class="form-control" type="text" id="passwordInsription">

              </div>

              <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                <div>
                  <button type="button" class="btn btn-primary" id="inscriptions"> Inscriptions </button>
                </div>
              </div>

             
            </div>


            <h2> Connection : </h2>
            <div class="row">
              <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                <label >Nom :</label>
                <input class="form-control"  type="text" id='nomConnection'>
              </div>

              <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                <label >Password :</label>
                <input class="form-control"  type="text" id="passwordConnection">
              </div>

              <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                <div>
                  <button type="button" class="btn btn-primary" id="connection"> Connection </button>
                </div>
              </div>

              <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">  </div>
            </div>


            <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                <label >Token de l'utilisateur</label>
                <textarea class="form-control"  type="text" id="token" style="width:100%; height:150px"></textarea>
                <button type="button" class="btn btn-primary" id="Verificationtoken">Verifier Token</button> 
              </div>


        </div>
      </div>


      <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
          <h2> Inscriptions action Pageana : </h2>
  
            <div class="row">
              <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                <label for="ip">ip :</label>
                <input class="form-control"  type="text" name="ip" id="ip">
              </div>

              <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                <label for="id_utilisateur"> id_utilisateur :</label>
                <input class="form-control"  type="text" name="id_utilisateur" id="id_utilisateur">
              </div>

              <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                <label for="url"> code_ecran:</label>
                <input class="form-control"  type="text" name="url" id="url">
              </div>

              <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                <label for="libelle_action"> libelle_action :</label>
                <input class="form-control"  type="text" name="libelle_action" id="libelle_action">
              </div>

              <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                <div class="button">
                  <button type="button" class="btn btn-primary" id="ajouts"> Ajouts Pageana </button>
                </div>
              </div>

              <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">  </div>

            </div>

            <div id="resAddPageana"></div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
          <h2> List Pageana : </h2>
          <button type="button" class="btn btn-primary" id="listePageana"> Obtenir la liste </button>
          <div id="res"></div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
          <h2> details Pageana : </h2>
          <label for="idPageana"> id_Pageana :</label>
          <input class="form-control"  type="text" name="idPageana" id="idPageana">
          <button class="btn btn-primary" type="submit" id="cherche"> chercher </button>
          <div id="details"></div>
        </div>
  </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
          <h2> Supresion Pageana : </h2>
          <label > id_Pageana :</label>
          <input class="form-control"  type="text"  id="idPageanasupresion">
          <button type="button" class="btn btn-primary" id="suprime"> suprimer </button>
          <div id="resDelete"></div>
        </div>
    </div>




    </main>
  </div>
</body>

</html>