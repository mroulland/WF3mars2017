// Créer un objet contenant 4 propriétés
var users = {
    first: 'Nesta',
    second: 'Bunny',
    third: 'Peter',
    fourth: 'Lee'
}; 

// Faire une boucle for ... in sur l'objet
// Prop = attribut qui s'intéresse aux propriétés uniquement, dès qu'il y en a plus, il s'arrête
for( var prop in users ){

    // Afficher le nom de la propriété
    console.log( prop ); 

    // Afficher la valeur des propriété
    console.log( users[prop] );

};