// Attendre que la page HTML soit chargée dans le navigateur

$( document ).ready( function(){

    // Le code de la page est à intégrer dans la fonction de Callback
    console.log( 'Le DOM est chargé' );


}); // Fin de la fonction d'attente de chargement du DOM dite 'Callback'

console.log( 'Le DOM n\'est pas chargé');