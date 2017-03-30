// Sélecteur de balise HTML (tag)

var myParaTag = document.getElementsByTagName('p');
console.log( myParaTag );

// Sélecteur de class

var myClass = document.getElementsByClassName('myClass');
console.log( myClass );

// Sélecteur d'id
var myId = document.getElementById('myId');
console.log( myId);


// Sélecteur querySelector
console.log( document.querySelector('h1') );
console.log( document.querySelector('h2[0]') );
console.log( document.querySelector('h1 + h2') ); // Il est possible de mettre tous les sélecteurs css qu'on veut à l'intérieur des guillemets

// Sélecteur querySelectorAll
console.log( document.querySelectorAll('.myClass') );