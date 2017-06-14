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

            // Afficher le titre du projet
            var modalTitle = $(this).prev().text();
            $('#modal span').text( modalTitle); 

            // Afficher l'image du projet
            var modalImg = $(this).parent().prev().attr('src')
            $('#modal img').attr( 'src', modalImg).attr( 'alt', modalTitle);

            $('#modal').fadeIn();
        });

        // Capter le clic sur la croix
        $('.fa-times').click(function(){

            $('#modal').fadeOut();
        });
       
    };

    // Créer une fonction pour la gestion du formulaire
    function contactForm(){

        $('input:not([type="submit"]), textarea').focus(function(){

            // Sélectionner la balise précédente pour lui ajouter la class openLabel
            $(this).prev().addClass('openedLabel hideError');
        });

        // Capter le blur sur les inputs et le textarea
        $('input, textarea').blur(function(){

            // Vérifier si il n'y a pas de caractères dans le input
            if( $(this).val().length == 0){

                // Sélectionner la balise précédent pour supprimer la class openedLabel
                $(this).prev().removeClass();
            };

        });

        // Supprimer le message d'erreur du select
        $('select').focus(function(){

            $(this).prev().addClass('hideError');
        });

        // Supprimer le message d'erreur de la checkbox
        $('[type="checkbox"]').focus(function(){

            $('form p').addClass('hideError');
        });

        // Capter le clic sur la croix
        $('.fa-times').click(function(){

            $('#modal').fadeOut();
        });

        // Capter la soumission du formulaire
        $('form').submit(function(evt){

            // Bloquer le comportement naturel du formulaire
            evt.preventDefault();

            // Définir les variables globales du formulaire
            var userName = $('#userName');
            var userEmail = $('#userEmail');
            var userSubject = $('#userSubject');
            var userMessage = $('#userMessage');
            var checkbox = $('[type="checkbox"]');

            var formScore = 0;

            // Vérifier que userName a au minimum 2 caractères
            if(userName.val().length < 2){
    
                // Afficher le message d'erreur
                $('[for="userName"] b').text('Minimum 2 caractères');

            } else{ 
                formScore++;
            }; 

            // Vérifier que userEmail a au moins 5 caractères
            if(userEmail.val().length < 5){

                // Afficher un message d'erreur
                $('[for="userEmail"] b').text('Minimum 5 caractères');

            } else{
                formScore++;
            };

            // Vérifier que userSubject est bien sélectionné
            if(userSubject.val() == 'null'){
                $('[for="userSubject"] b').text('Vous devez choisir un sujet');

            } else{
                formScore++;
            };

            // Vérifier si il y a au moins 5 caractères dans le message
            if(userMessage.val().length < 5){
                $('[for="userMessage"] b').text('Minimum 5 caractères');

            } else{
                formScore++;
            };

            // Vérifier si la checkbox est bien cochée
            if(checkbox[0].checked == false){
                $('form p b').text('Vous devez acceper les conditions générales'); 

            } else{
                formScore++;
            };

            // Vérifier la valeur de formScore
            if(formScore == 5){
                console.log('Le formulaire est validé')
                // => Envoie des données dans le fichier de traitement PHP
                // Réponse du php : true => continuer le traitement du formulaire

                // Ajouter la valeur de userName dans la balise h2 span de la modal
                $('#modal span').text( userName.val());

                // Afficher la modal
                $('#modal').fadeIn();

                // Vider les champs du formulaire
                $('form')[0].reset();

                // Supprimer les messages d'erreur
                $('form b').text('');

                // Replacer les labels
                $('label').removeClass();
            };
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

        // Créer une variable pour récupérer la valeur de l'attribut href des liens de la nav
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

                    // Vérifier si l'utilisateur est sur la page portfolio.html
                    if( viewToLoad == 'portfolio.html'){

                        // Appeler la fonction pour ouvrir la modal
                        openModal();
                    };

                    // Vérifier si l'utilisateur est sur la page Contacts.html
                    if(viewToLoad == 'contacts.html'){

                        // Appeler la fonction de gestion du formulaire
                        contactForm();
                    }
                });

            });


        });

    });


}); // Fin de la fonction d'attente du chargement du DOM