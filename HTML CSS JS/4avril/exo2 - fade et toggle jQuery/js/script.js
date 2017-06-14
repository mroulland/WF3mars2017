// Attendre le chargement du DOM

$(document).ready(function(){
    console.log('Le DOM est chargé !');

    // Fonction fadeOut()
    $('section').eq(0).children('button').click(function(){ // eq c'est pour le numéro d'enfant, équivalent du nth child en jQuery

        $('section').eq(0).children('article').fadeOut(2000); //slow, fast ou durée en milisecondes

    });

    // Fonction fadeIn()
    $('section').eq(1).children('button').click(function(){ // eq c'est pour le numéro d'enfant, équivalent du nth child en jQuery

        $('section').eq(1).children('article').fadeIn(1500); //slow, fast ou durée en milisecondes

    });

    // Fontion fadeToggle()
   $('section').eq(2).children('button').click(function(){

        $('section').eq(2).children('article').fadeToggle(1000);
    });


    // Fonction slideUp()
    $('section').eq(3).children('button').click(function(){ 
        $('section').eq(3).children('article').slideUp(1000);

    });

    // Fonction slideDown()
    $('section').eq(4).children('button').click(function(){ 
        $('section').eq(4).children('article').slideDown(1000);

    });

    // Fonction slideTogggle()
    $('section').eq(5).children('button').click(function(){
        $('section').eq(5).children('article').slideToggle(2000);
    });







}); // Fin de la fonction d'attente