/*ressemble à du C*/
/*fonctions Jquery pour DA*/
//il faut lier cette page au reste du site via lien index comme css
// ce qui suit est obligatoire, ça veut dire attendre que tout doit charger avant que Jquery commence
$(document).ready(function () {       //$ = jquery, ça remplace ce mot
    //alert("Coucou");    //pop-up
    //retirer bouton valider du filtre pour les labels    
    $('#submit_choix_maison').remove();   //on supprime
    $('#choix_maison').change(function () {
        var param = $(this).attr('name');   //on choisi le name de choix_maison
        var val = $(this).val();            //on va chercher valeur
        var refresh = 'index.php?' + param + '=' + val + '&submit_choix_maison=1';         //on refresh en reconstruisant url selon choix         
        location.href = refresh;                //on envoie url
        // var = limite la variable à ici
    });

    //retirer bouton valider du filtre pour les artistes   
    $('#submit_choix_label').remove();   //on supprime
    $('#choix_label').change(function () {
        var param = $(this).attr('name');   //on choisi le name de choix_label
        var val = $(this).val();            //on va chercher valeur
        var refresh = 'index.php?' + param + '=' + val + '&submit_choix_label=1';         //on refresh en reconstruisant url selon choix         
        location.href = refresh;                //on envoie url
    });

    //retirer bouton valider du filtre pour les albums   
    $('#submit_choix_artiste').remove();   //on supprime
    $('#choix_artiste').change(function () {
        var param = $(this).attr('name');   //on choisi le name de choix_artiste
        var val = $(this).val();            //on va chercher valeur
        var refresh = 'index.php?' + param + '=' + val + '&submit_choix_artiste=1';         //on refresh en reconstruisant url selon choix         
        location.href = refresh;                //on envoie url
    });


    //new
    //code pour le tableau éditable
    $("span[id]").click(function () {
        //Récupération du contenu d'origine de la zone cliquée
        var valeur1 = $.trim($(this).text());

        //s'il fallait tester si on utilise edge :
        if (/Edge\/\d./i.test(navigator.userAgent)) {
            $(this).addClass("borderInput");
        }

        //2 lignes suivantes pour firefox
        //$(this).contentEditable = "true";
        //$(this).addClass("borderInput");

        //récupération, pour la zone cliquée, des attributs id et name, pour les envoyer à la requête sql
        var ident = $(this).attr("id");
        var name = $(this).attr("name");

        $(this).blur(function () {
            $(this).removeClass("borderInput");
            //récupération de la nouveau contenu du champ qui vient de perdre le focus (blur)
            var valeur2 = $(this).text();
            valeur2 = $.trim(valeur2);

            if (valeur1 != valeur2) // Si on a fait un changement
            {
                //adjonction des paramètres qui accompagnent le nom du fichier appelé
                var parametre = 'champ=' + name + '&id=' + ident + '&nouveau=' + valeur2;
                var retour = $.ajax({
                    type: 'GET',
                    data: parametre,
                    dataType: "text",
                    url: "./lib/php/ajax/ajaxUpdateMaison.php",
                    success: function (data) {
                        //rien de particulier à faire
                        console.log("success");
                    }
                });
                retour.fail(function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                });
            }
            ;
        });
    });

});   