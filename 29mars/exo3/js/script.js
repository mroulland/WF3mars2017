var first = 20;
var second = 20; 
var third = 10;

// "et" logique : vérifier que les deux variables ont la même valeur
console.log( first && second == 20 ); // => true (il faut que les deux soient = à 10)
console.log( first == 10 && third == 10); // => false (un seul des deux est égal à 10)

// "ou" logique : vérifier qu'une des variables à la bonne valeur
console.log(first == 20 || second == 15); // => True, car first est bien égale à 20
console.log( first == 30 || first >= 20 ); // => True, car first est bien égale à 20

