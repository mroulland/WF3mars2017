/* 
    
    Ajouter une balaise HTML dans la DOM
    - Sélectionner le document
    - Appliquer la fonction write
    - Ajouter le contenu

*/

document.write('<p>Je suis générée en JavaScript</p>');

var names = ['Pierre', 'Paul', 'Jacques'];

for( var i =0; i < names.length; i++ ){

    document.write('<p>Salut ' + names[i] + '</p>')
}