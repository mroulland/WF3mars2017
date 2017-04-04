// Attendre le chargement du DOM

$(document).ready(function(){

    $('h3').click(function(){

        // Fermer la balise suivant .open
        $('.open').not(this).next().slideUp().prev().removeClass('open');

        // Faire un toggle sur la class open sur la balise h3
        $(this).toggleClass('open');

        // Faire un slideToggle sur la balise suivante du h3
        $(this).next().slideToggle();

        // Afficher dans la console .fa
        //console.log($(this).children('.fa') )

        // Sélectionner la balise .fa pour toggle la class fa-arrow-right et un toggle sur la class fa-times
        $(this).children('.fa').toggleClass('fa-arrow-right').toggleClass('fa-arrow-down');

    });




}); // Fin de la fonction d'attente