//  Sélectionner la balise h1
var myTitle = document.querySelector('h1');

// Afficher le contenu texte de la balise dans la console
console.log( myTitle.textContent);

// Modifier le contenu texte de la balise
myTitle.textContent = 'Le titre a changé';

// Sélectionner la balise #myId
var myId = document.querySelector('#myId');

// Afficher le contenu HTML dans la console
console.log( myId.innerHTML ); 

// Modifier le contenu HTML dde la balise
myId.innerHTML = 'Contactez <b>moi</b> les gars : <a href="mailto:morg@ne.fr">Mail</a>';
