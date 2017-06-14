// Attendre le chargement du DOM
$( document ).ready( function(){

    // Code à exécuter sur la page une fois chargée



    /*
    Les sélecteurs jQuery "classiques"
    */

    // Sélection d'une balise par son nom (tag)
    var myHtmlTag = $('header');  // $ = document.querySelector
    console.log(myHtmlTag);

    // Sélectionner une/des balise/s par sa class
    var myClass = $('.myClass');
    console.log(myClass);

    // Sélectionner une/des balises par son id
    var myId = $('#myId');
    console.log(myId);

/* Entre parenthèses, on écrit tout simplement les sélecteurs CSS3 exactement comme on les aurait tapé dans le .css */

    // Sélecteur imbriqué
    var myItalic = $('h2 i');
    console.log( myItalic );

    // Sélecteur CSS3
    var myFooter = $('body > main + footer');
    console.log( myFooter );

/*
    Les sélecteurs jQuery spécifiques 
*/

    // Sélécteurs d'enfants
    var myChildren = $('header').children('button');
    console.log( myChildren);

    // Sélecteur de parents
    var myParent = $('h2').parent(); // On ne précise rien dans les parenthèses car le parent, c'est le parent.
    console.log(myParent);

    // Rechercher (et trouver) une balise
    var myH2 = $('main').find('h2');
    console.log(myH2);

    // Sélectionner le premier
    var firstBtn = $('button:first');
    console.log(firstBtn);

    // Sélectionner le dernier
    var lastBtn = $('button:last');
    console.log(lastBtn);

    // Sélectionner la nth balise
    var secondLi = $('li').eq(1);  // eq est une fonction pour equals
    console.log( secondLi ); 

    // Sélectionner la balise suivante
    var afterMain = $('main').next(); 
    console.log( afterMain );

    // Sélectionner la balise précedente
    var beforeMain = $('main').prev();
    console.log( beforeMain);


    /*
        Le deathSelector
    */

    var deathSelector = $('h3').prev().parent().parent().next().parent().find('main').children('article').find(h3);
    console.log ('Balise sélectionnée : ', deathSelector)


}) // Fin de la fonction d'attente du chargement du DOM

