/* 
    - Créer un tableau contenant 4 prénoms dont le votre
    - Faire une boucle sur le tableau pour saluer dans la console chacun des prénoms

*/

var namesArray = ['Morgane', 'Laurine', 'Lydia', 'Alexia'];
console.log(namesArray);

for( var i =0; i < namesArray.length; i++ ){

    if (namesArray[i] == 'Morgane'){
    console.log( 'Salut, c\'est moi !');
    
    // Modifier une balise HTML
    document.querySelector('p').textContent = "Salut c'est moi !";

    } else{
    console.log( 'Salut ' + namesArray[i]);    
    }


}