// Attendre le chargement du DOM
$('document').ready(function(){


    // Manipuler le contenu texte du footer
    console.log($('footer').text() );
    // $('footer').text('Sous la licence MIT');

    // Manipuler le contenu HTML du footer
    console.log( $('footer').html() );
    $('footer').html('Sous la licence <b>MIT</b>');

    // Créer un objet pour la page d'accueil
    var homeContent = {
        title: 'Bienvenue sur mon site',
        content: 'Je suis le texte de la page <b>Accueil</b>'
    };

    var portfolioContent = {
        title: 'Bienvenue sur mon portfolio',
        content: 'Je suis le texte de la page <b>Portfolio</b>'
    };

    var contactContent = {
        title: 'Bienvenue sur la page contact',
        content: 'Je suis le texte de la page <b>Contact</b>'
    };



    //  Créer une fonction pour gérer le menu
    function showMyContent(){

        // Capter le click sur la première li
        $('li').click( function(){

            // Récupérer la valeur de l'attribut data
            var dataValue = $(this).attr('data');

        // Modifier le contenu de la balise h2
        $('h2').text( dataValue.title);

        // Modifier le contenu de la balise p
        $('p').html( dataValue.content);
    

        });
    }
    
    showMyContent();

}); // Fin de la fonction de chargement du DOM