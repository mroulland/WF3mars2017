// Attendre le chargement du DOM
$(document).ready(function(){

    // Créer une variable (string) pour le titre principal du site
    var siteTitle = 'Morgane Roulland <span>Future As du JavaScript</span>';

    // Créer un tableau pour la nav
    var myNav = ['Accueil', 'Portfolio', 'Contacts'];


    // Créer un objet pour les titres des pages
    var myTitles = {
        Accueil: 'Bienvenue sur la page d\'accueil',
        Portfolio: 'Découvrez mes travaux',
        Contacts: 'Contactez-moi pour plus d\'informations'
    };

    // Créer un objet pour le contenu des pages
    var myContent = {
        Accueil: '<h3>Contenu de la page Accueil</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad repellat quasi suscipit asperiores esse qui? Facilis labore error iusto ipsum aspernatur cumque, eveniet doloremque. Ipsa, error ea iure ut cum.</p>',
        Portfolio: '<h3>Contenu de la page Portfolio</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae recusandae vel perspiciatis ipsa quasi magnam enim quas. Dolore alias natus dignissimos! Nemo ex exercitationem fugiat sunt, unde ab accusamus repudiandae.</p>',
        Contacts: '<h3>Contenu de la page Contacts</h3><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione minus aliquam, maiores, soluta amet recusandae. Rem consequuntur quod illum. Nulla quidem minima voluptates natus nisi neque aliquam, laboriosam vitae numquam.</p>',
    }

    // Sélectionner le header et le mettre dans une variable
    var myHeader = $('header');

    // Générer une balise H1 dans le header avec le contenu de la variable siteTitle
    myHeader.append('<h1>' + siteTitle + '</h1>');

    // Générer une balise nav + ul dans le header
    myHeader.append('<nav><i class="fa fa-bars" aria-hidden="true"></i><ul></ul></nav>');

    // Activer le burgerMenu au click sur la balise .fa-bars
    $('.fa-bars').click( function(){

        $('nav ul').toggleClass('toggleBurger');
    })

    // Faire une boucle for(){...} sur myNav pour générer les liens de la nav
    for(var i = 0; i < myNav.length; i++){

        //  Générer les balises html
        $('ul').append('<li><a href="' + myNav[i] + '">' + myNav[i] + '</a></li>');

    };

    // Afficher dans le main le titre issu de l'objet myTitles (Ici, on travaille sur ce qui est affiché dès le départ sur la page d'Accueil)
    var myMain = $('main');
    myMain.append('<h2>' + myTitles.Accueil + '</h2>');
    myMain.append('<section>' + myContent.Accueil + '<section>');

    // Ajouter la class active sur la première li de la nav
    $('nav li:first').addClass('active');

    // Capter l'évènement click sur les balises a en bloquant le comportement naturel des balises a
    $('a').click(function(evt){
        
        // Supprimer la class 'active' des balises li de la nav
        $('nav li').removeClass('active');

        // Bloquer le comportement naturel de la balise
        evt.preventDefault();

        // Connaitre l'occurence de la balise a sur laquelle l'utilisateur a cliqué
        // console.log( $(this) );  // This permet de savoir, quand on a plusieurs occurences qui peuvent déclencher une fonction, LAQUELLE a déclenché cette fonction

        // Récupérer la valeur de l'attribut href
        // console.log($(this).attr('href') );

        // Vérifier la valeur de l'attribut href pour afficher le bon titre
        if( $(this).attr('href') == 'Accueil' ){
            // Sélectionner la balise h2 pour changer son contenu
            $('h2').text( myTitles.Accueil );

            // Séléctionner la section pour changer son contenu
            $('section').html(myContent.Accueil);

            // Ajouter la class active sur la balise li de la balise a sélectionnée
            $(this).parent().addClass('active');


        } else if($(this).attr('href') == 'Portfolio'){
            // Sélectionner la balise h2 pour changer son contenu
            $('h2').text( myTitles.Portfolio );

            // Séléctionner la section pour changer son contenu
            $('section').html(myContent.Portfolio);
            
            // Ajouter la class active sur la balise li de la balise a sélectionnée
            $(this).parent().addClass('active');
  
        } else{
            // Sélectionner la balise h2 pour changer son contenu
            $('h2').text( myTitles.Contacts );

            // Séléctionner la section pour changer son contenu
            $('section').html(myContent.Contacts);

            // Ajouter la class active sur la balise li de la balise a sélectionnée
            $(this).parent().addClass('active');
        };

        // Fermer le burgerMenu
        $('nav ul').removeClass('toggleBurger');


    });







}); // Fin de la fonction d'attente du chargement du DOM