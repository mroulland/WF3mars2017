// Attendre le chargement du DOM

$(document).ready(function(){

    // Afficher l'image correspondant au chat sélectionné

    // Capter le changement sur le select
    $('select').change( function(){

        // Modifier l'image en fonction
        if( $(this).val() == 'Sushi'){
            $('section:first-child img').attr('src', 'img/chat_1.jpg');

        } else if( $(this).val() == 'Maki'){
            $('section:first-child img').attr('src', 'img/chat_2.jpg');

        } else if( $(this).val() == 'Sashimi'){
            $('section:first-child img').attr('src', 'img/chat_3.jpg');

        } else if( $(this).val() == 'Yakitori'){
            $('section:first-child img').attr('src', 'img/chat_4.jpg');

        } else if( $(this).val() == 'Onigiri'){
            $('section:first-child img').attr('src', 'img/chat_5.jpg');
            
        } else{
            $('section:first-child img').attr('src', 'img/chat_0.jpg');
        };

    }); // Fin de la fonction change()


    // Capter la sélection d'un champ du formulaire
    $('select, textarea').focus(function(){

        // Enlever la classe 'error' lorsqu'on sélectionne un champ
        $(this).removeClass('error');
    });


    // Capter la soumission du formulaire 
    $('form').submit(function(evt){

        // Empêcher le comportement naturel du formulaire
        evt.preventDefault();
        
        // Définir les variables générales
        var userChoice = $('select');
        var userMessage = $('textarea');

        var formScore = 0;


        // Vérifier les champs du formulaire
        if(userChoice.val() == 'null'){
            // Ajouter la class 'error'
            $(userChoice).addClass('error');

        } else{
            // Incrémenter formScore
            formScore++;
        };

        if(userMessage.val().length < 15){
            // Ajouter la class 'error'
            $(userMessage).addClass('error');   

        } else{
            // Incrémenter formScore
            formScore++;
        };

        // Vérifier la valeur de formScore
        if(formScore == 2){

            // Afficher le message de remerciements 
            $('section:first-child article').html('<h2>Merci !</h2>' + '<p>Vous avez bien choisi ' + userChoice.val() + ' !</p>' );
        };

    })







}); // Fin de la fonction d'attente de chargement du DOM