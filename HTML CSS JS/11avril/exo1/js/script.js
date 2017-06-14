// Attendre le chargement du DOM

$(document).ready(function(){

    // Définir une variable
    var boxChecked;


    // UI (user interface) checkbox
    $('[type="checkbox"]').click(function(){
        
        // Définir la valeur de boxChecked
        boxChecked = $(this).val();

        var checkboxArray = $('[type="checkbox"]').not( $(this) );

        for(var i = 0; i < checkboxArray.length; i++){

            // Décocher les checkbox 
            checkboxArray[i].checked = false;
        };

    // Modifier l'image
        if( $(this).val() == 'first'){
            $('img').attr('src', 'img/img1.jpg');
            console.log('first');
        
        } else if( $(this).val() == 'second'){
            $('img').attr('src', 'img/img2.jpg');
            console.log('second');

        } else if( $(this).val() == 'third'){
            $('img').attr('src', 'img/img3.jpg');
            console.log('third');

        } else{
            $('img').attr('src','img/img4.jpg');
            console.log('fourth');
        };
    });

    // Fermer la modal au click sur la croix
    $('.fa-times').click(function(){
        $('#modal').fadeOut();
    })

    // Capter la soumission du formulaire
    $('form').submit(function(evt){

        // Bloquer le comportement par défaut du formulaire
        evt.preventDefault();

        /*
            - Vérifier quelle checkbox est cochée
            - Afficher une modal avec l'image sélectionnée
            - Réinitialiser le formulaire
        */

        if(boxChecked == undefined){
            console.log('Vous devez choisir une image');

        } else{
            // Afficher la modal
            $('#modal').fadeIn();

        }
        
        console.log(boxChecked);

    }); // Fonction submit du formulaire








}); // Fin de la fonction d'attente de chargement du DOM