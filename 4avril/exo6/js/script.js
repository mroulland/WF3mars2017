// Attendre le chargement du DOM
$(document).ready(function(){
    

    // Burger menu
    /*
        - "Quand je clique sur cette balise, il faut activer le menu"
        - On capte le clic sur la balise a qui suit le h1
        - Bloquer le comportement naturel de la balise a (qui nous emmène sur une autre page)
        - On applique la fonction slideToggle sur la nav pour lui permettre de se dérouler
        - On va capter le clic sur les a des li pour bloquer leur fonctionnement
        - On demande à la nav de se refermer après avoir capté le click sur un des liens
        - Comment indiquer aux liens vers quelle page ils doivent charger ?
        - La fonction window.location permet de rediriger vers la bonne page
        - On cherche à récupérer l'attribut href des balises a pour les renvoyer dans la fonction call back window location
    */

/*

HOMEPAGE

*/



    // Burger Menu : ouverture
    $('.homePage h1 + a').click(function(evt){
        // Bloquer le comportement naturel
        evt.preventDefault();

        // Appliquer la fonction slideToggle sur la nav

        $('.homePage nav').slideToggle();

    });

    // Burger menu : navigation
    $('.homePage nav a').click(function(evt){

        // Bloquer le comportement naturel de la balise a
        event.preventDefault();

        var linkToOpen = $(this).attr('href')  // On la place ici et non en dessous pour que le "this" fasse référence au "nav a" et non juste au "nav" plus bas


        // Fermer le burger menu
        $('.homePage nav').slideUp(function(){

            // Changer de page
            window.location = linkToOpen;

        });

    });


    /*
        ABOUTPAGE
    */

    // Capter le clic sur le burger menu
    $('.aboutPage h1 + a').click(function(evt){

        // Bloquer le comportement naturel de la balise A
        evt.preventDefault();

        // Sélectionner la nav pour y appliquer une fonction animate
        $('.aboutPage nav').animate({

            left: '0'

        });
    });

    // Burger menu : navigation
    $('.aboutPage nav a').click(function(evt){

        // Bloquer le comportement naturel de la balise a
        event.preventDefault();

        var linkToOpen = $(this).attr('href')  // On la place ici et non en dessous pour que le "this" fasse référence au "nav a" et non juste au "nav" plus bas


        // Fermer le burger menu
        $('.aboutPage nav').animate({
            left: '-100%'

        }, function(){
            
            // Changer de page
            window.location = linkToOpen;

        }); 

    });

    
}); // Fin de la fonction d'attente du chargement du DOM