// Attendre le chargement du DOM
$(document).ready(function(){


    // Créer une fonction pour l'animation des compétences
    function mySkills(paramEq, paramWidth){

        // Animation des balises p des mySkills
        $('h3 + ul').children('li').eq(paramEq).find('p').animate({
            width: paramWidth
        }, 2000);
        
    };

    // Créer une fonction pour afficher la modal
    function openModal(){

        // Capter le clic sur le bouton
        $('button').click(function(){

            $('#modal').fadeIn();
        });

        // Capter le clic sur la croix
        $('.fa-times').click(function(){

            $('#modal').fadeOut();
        });
         
    };

    function changeButton(paramButton, paramImg){

        // Capter le clic sur le bouton 
        $('button').eq(paramButton).click(function(){
             $('#imgModal').attr('src', 'img/' + paramImg + '.jpg');
        
        });
    };


    // Charger le contenu de home.html dans le main
    $('main').load('views/home.html');
    


/*

BurgerMenu

*/

    // Burger menu : ouverture
    $('h1 + a').click(function(evt){
        // Bloquer le comportement naturel
        evt.preventDefault();

        // Appliquer la fonction slideToggle sur la nav

        $('nav').slideToggle();

    });

    // Burger menu : navigation
    $('nav a').click(function(evt){

        // Bloquer le comportement naturel de la balise a
        event.preventDefault();

        //  Masquer le main
        $('main').fadeOut();

        var viewToLoad = $(this).attr('href')  // On la place ici et non en dessous pour que le "this" fasse référence au "nav a" et non juste au "nav" plus bas


        // Fermer le burger menu
        $('nav').slideUp(function(){

            // Charger la bonne vue puis afficher le main (callBack)
            $('main').load('views/' + viewToLoad, function(){

                $('main').fadeIn(function(){
                    
                    // Vérifier si l'utilisateur veut voir la page about.html
                    if( viewToLoad == 'about.html'){ 

                        // Appeler la fonction mySkills
                        mySkills( 0, '60%');
                        mySkills(1, '20%');
                        mySkills(2, '10%');
                    };

                    if( viewToLoad == 'portfolio.html'){

                        // Appeler la fonction pour ouvrir la modal
                        openModal();

                        // Si l'utilisateur veut afficher la modal, elle doit se charger en fonction du bouton sur lequel on appuie
                        changeButton(0, 'img1');
                        changeButton(1, 'img2');
                        changeButton(2, 'img3');
                        changeButton(3, 'img4');
                    };
                });

            });


        });

    });


}); // Fin de la fonction d'attente du chargement du DOM