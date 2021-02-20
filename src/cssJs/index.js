$(document).ready(function () {

    // Permet d'integrer le token à toutes les entête des requetes 
    // dans la section "Authorization"
    $.ajaxSetup({
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', $('#token').val());
        }
    });

    // Requete et mise à jours de la liste de tous les Pageana en bdd
    listPageana();
    function listPageana() {
        $.ajax({
            url: './server/api.php?call=getpageana',
            method: "GET",
            dataType: "json",
        })
            // Si la requete réussis.
            .done(function (response) {
                let data = JSON.stringify(response);
                /*
                let c = jQuery.parseJSON(data);
                let html = ' ';
                for (var i = 0; i < c.length; i++) {
                    html = html + 'id_pageana  ' + c[i].id_pageana + ' libelle_action ' + c[i].libelle_action + ' <br>'
                }*/
                $("#res").html(data);
            })

    }


    // Requete et mise a jours du details d'une Pageana
    function detailsElement() {
        var idPageana = $('#idPageana').val();
        $.ajax({
            url: './server/api.php?call=getpageana&id=' + idPageana,
            method: "GET",
            dataType: "json",
        })
            .done(function (response) {
                console.log(response)
                let data = JSON.stringify(response);
                
                $("#details").html(data);
            })

    }







    // **************************************************************
    // Interactions utilisateur 
    // **************************************************************

    // Recherche détaisl sur un elements
    $('#cherche').on('click', function () {
        detailsElement();
    })


    // Supressionn d'un element
    $('#suprime').on('click', function () {
        var idPageana = $('#idPageanasupresion').val();
        var call = 'deletepageana';
        $.ajax({
            url: './server/api.php',
            method: "DELETE",
            data: 'call=' + call + '&id=' + idPageana,
            dataType: "json",
        })
            .done(function (response) {
                
                

                $("#resDelete").html(JSON.stringify(response));
                detailsElement();
                listPageana();
            })

    })

    // obtenir la liste des pageana
    $('#listePageana').on('click',listPageana);

    // Ajout d'une pageana
    $('#ajouts').on('click', function () {
        let description = 'insertpageana';
        $.ajax({
            url: ' ./server/api.php',
            type: 'PUT',
            data: 'ip=' + $('#ip').val() + ' &id_utilisateur=' + $('#id_utilisateur').val() + '&url=' + $('#url').val() + '&libelle_action=' + $('#libelle_action').val() + '&call=' + description,
            dataType: 'json'
        })
            .done(function (response) {
                listPageana();
                $("#resAddPageana").html(JSON.stringify(response));
            })
    })


    // Inscriptions d'un utilisateur
    $('#inscriptions').on('click', function () {
        $.ajax({
            url: ' ./server/api.php',
            type: 'POST', // Le type de la requête HTTP, ici devenu POST 
            data: 'nom=' + $('#nomInsription').val() + '&password=' + $('#passwordInsription').val() + '&call=inscriptionUser',
            dataType: 'json'
        }).done(function (response) {
            alert(response);
        })

    })


    // Connection d'un utilisateur
    $('#connection').on('click', function () {
        $.ajax({
            url: ' ./server/api.php',
            type: 'POST', // Le type de la requête HTTP, ici devenu POST 
            data: 'nom=' + $('#nomConnection').val() + '&password=' + $('#passwordConnection').val() + '&call=ConnectionUser',
            dataType: 'json'
        }).done(function (response) {
            
            console.log("Token de l'utilisateur : " + response);
            document.querySelector("#token").value = response;
        })
    })

    // Vérification de a validiter de notre token
    $('#Verificationtoken').on('click', function () {
        $.ajax({
            url: ' ./server/api.php?call=getToken',
            method: "GET",
            dataType: "json",
        }).done(function (response) {
            alert(JSON.stringify(response));
        })

    })








});



