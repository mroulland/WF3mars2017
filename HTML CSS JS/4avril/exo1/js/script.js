// Attendre le chargement du DOM

$(document).ready(function(){
    console.log('Le DOM est chargé !');

    // fonction animate()
    $('section:first button').click(function(){
        
        console.log('click');

        // Changer la largeur et la hauteur de l'article
        $('section:first article').animate({ //La fonction animate prend un objet comme paramètre entre {}
            height: '20rem',  // ceci sont les propriétés d'un objet (possible d'utiliser du css)
            width: '20rem'
        });

    });

    // Fonction animate() valeurs dynamiques
    $('section:nth-child(2) button').click(function(){

        console.log('click 2');
        $('section:nth-child(2) article').animate({

            // Pas d'espace entre += et la valeur
            left: '+=1rem',
            top: '-=1rem',

        });
    });

    // Fonction animate() : toggle/show/hidden
    $('section:nth-child(3) button').click(function(){

        $('section:nth-child(3) article').animate({

            width: 'toggle'
        });
    });
    
    // Fonction animate() avec durée et callBack (c'est une fonction qui se lance à la fin d'une autre fonction)
    $('section:last button').click(function(){

        $('section:last article').animate({

            width: '20rem',
            height: '20rem'
        }, 2000, function(){ // Pour la durée, on l'indique après } de l'objet, avec une virgule et un temps compté en milisecondes );
            
            alert('Fin de l\'animation');

        });  
        
    });




}); // Fin de la fonction d'attente