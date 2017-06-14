// Attendre le chargement du DOM

$(document).ready(function(){

    //   Ouvrir la modal
    $('button').click(function(){
        $('section').fadeIn();
    });

    // Fermer la modal
    $('.fa, section').click(function(){

        $('section').fadeOut();  // = $ (this).parent().parent().parent()aussi ...

    });

    // Capter les touches du clavier
    $(document).keyup(function(evt){ //evt est un objet (évènement) qu'on peut inspecter, avec des propriétés

        console.log(evt.keyCode); // On peut donc commander à l'evt de nous donner la valeur de la propriété keyCode pour déterminer sur quelle touche du clavier on a cliqué
        
        if(evt.keyCode == 27){
            $('section').fadeOut();
        };
    });



}); // Fin de la fonction d'attente