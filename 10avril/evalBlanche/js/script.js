// Fonction d'attente du chargement du DOM

$(document).ready(function(){

    // Enlever le message d'erreur quand on click sur un champ 
    $('input, textarea, select').focus( function(){
        $('form > p').text('');
        $(this).removeClass('error');
    });

    // Fermer la modal : capter le clic sur la croix
    $('.fa-times').click(function(){
        $('div').fadeOut();

    });


    // Capter la soumission du formulaire 
    $('form').submit(function(evt){

        // Empêcher le comportement par défault
        evt.preventDefault();

        // Définir les variables générales
        var userName = $('[type="text"]');
        var userSubject = $('select');
        var userNumber = $('[type="number"]');
        var userMessage = $('textarea');

        var formScore = 0;

        // Vérifier les champs du formulaire
        if( userName.val().length == 0){

            // Ajouter la class error sur l'input
            userName.addClass('error');

        } else{
            // Incrémenter formScore
            formScore++;
        };

        if( userSubject.val() == 'null'){
            userSubject.addClass('error');

        } else{
            formScore++;
        };

        if( userNumber.val().length < 10){
            userNumber.addClass('error');

        } else{
            formScore++;
        };

        if( userMessage.val().length < 5){
            userMessage.addClass('error');

        } else{
            formScore++;
        };

        // Vérifier la valeur de formScore
        if( formScore == 4){

            // Formulaire OK
            // Envoi des données vers le fichier PHP => Retour du PHP = true

            // Afficher les données du formulaire dans une modal
            $('div span').text( userName.val() );
            $('div b').text( userSubject.val() );
            $('div p:last').text( userMessage.val() );

            // Afficher la modal
            $('div').fadeIn();

            // Vider le formulaire
            $('form')[0].reset();

            // Confirmer l'envoi du message 
            $('form > p').text('Message bien envoyé');

        } else{
            $('form > p').text('Veuillez remplir tous les champs du formulaire');
        }

    }); // Fin soumission du formulaire



}); // Fin de la fonction d'attente de chargement du DOM