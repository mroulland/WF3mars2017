// Capter l'évènement ready pour y ajouter une fonction de callback (attendre le chargement du DOM)

$(document).ready(function(){



    // Capter l'évènement focus sur le textarea
    $('textarea').focus( function(){

        console.log('Minimum 10 caractères');    
    } ); // Focus est une fonction

    // Capter l'évènement blur sur le textarea
    $('textarea').blur( function(){

        console.log("L'utilisateur est sorti du focus");
    });

    // Capter l'évènement scroll sur le header
    $('header').scroll( function(){

        console.log('Scroll');
    });

    // Capter l'évènement hover sur le main
    $('main').hover( function(){

        console.log("L'utilisateur est au dessus du main");

    });

    // Capter l'évènement clock sur ma balise a
    $('a').click( function(evt){  //La fonction callback a la possibilité de récupérer le clic pour en faire ce qu'elle veut
        // Empêcher le comportement naturel de la balise a (c'est à dire ouvrir la page Google ici)
        evt.preventDefault(); // On peut mettre ce qu'on veut à la place d'evt

        console.log('click sur la balise a');
    });

    
    // Capter la soumission du formulaire
    $('form').submit( function(evt){

        // Bloquer le comportement naturel du formulaire
        evt.preventDefault();

        console.log('Vérifier les inputs/textarea avant de les envoyer au fichier de traitement PHP')


    })



}); // Fin de la fonction d'attente de chargement du DOM

