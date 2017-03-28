// Créer une fonction sans paramètres
function helloWorld(){

    // Ecrire le code à executer à l'appel de la fonction
    console.log('Bonjour le monde !');

};

// Appeler la fonction
helloWorld();

// Créer une fonction avec des paramètres
function fullName(firstName, lastName){

    console.log('Bonjour ' + firstName + ' ' + lastName);

};

//  Appeler la fonction en précisant les paramètres
fullName( 'Morgane', 'Roulland' );
fullName( 'Thomas', 'Smith' );
fullName( 'John', 'Doe' );