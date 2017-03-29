/*

    Créer un tableau contenant 4 index
        - 1 string
        - 1 number
        - 2 booléans différents
    Afficher le tableau dans la console
*/

var myArray = [ 'Du texte', 1979, true, false];
console.log( myArray );

/*
    Ajouter un string dans le tableau
    Afficher le tableau dans la console
*/

myArray.push( 'Nouvelle phrase de texte' );
console.log( myArray );

/*
    Afficher dans la console la taille du tableau
    Afficher le premier et le dernier index du tableau dans la console
*/

console.log('La longueur du tableau est de ' + myArray.length);
console.log(myArray[0]);
console.log(myArray[4]);

// On peut aussi tout compiler grace à une virgule
console.log(myArray.length, myArray[0], myArray[4]);

/* 
    Créer un objet contenant 3 propriétés 
        - le tableau
        - 1 prénom
        - 1 âge
    Afficher le tableau dans la console
*/

var myObject = {
    array: myArray,
    // On indique qu'on veut un tableau (les noms des propriétés doivent être basiques), et on appelle la variable qu'on a crée précédemment
    name: 'Morgane',
    age: 25,
}

console.log(myObject);

/* 
    Afficher toutes les propriétés de l'objet dans la console 
*/
console.log(myObject.array);
console.log(myObject.name);
console.log(myObject.age);

/*
    Modifier la propriété âge de l'objet
    Afficher l'objet dans la console
*/

myObject.age = 26;
console.log( myObject );
