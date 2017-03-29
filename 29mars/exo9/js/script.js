// Créer un tableau contenant 3 prénoms
var users = ['John', 'Georges', 'Paul', 'Ringo'];

console.log(users);

// Faire une boucle while sur le tableau pour saluer chacun des prénoms
// Définir une variable i à 0
 var i = 0;

//  Limier la boucle à la taille du tableau
while( i < users.length ){

    console.log( 'Salut ' + users[i]);

    // Incrémenter la variable
    i++;
}