// Créer un tableau contenant 3 prénoms
var users = ['John', 'Georges', 'Paul', 'Ringo'];


// Faire une boucle for sur le tableau pour saluer chacun des prénoms
// On commence toujours par définir une variable qui s'appellera toujours i et qui commencera toujours à 0. Puis on lui donne pour instruction de continuer chaque fois que i est inférieur à la longueur du tableau, puis on finit en lui disant d'ajouter +1 à la valeur de i à chaque fin de boucle

for( var i = 0; i < users.length; i++ ){

    // Code à exécuter à chaque itération (boucle)
    console.log('Salut '+ users[i]);    
};

