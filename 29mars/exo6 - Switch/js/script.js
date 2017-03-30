// Créer une fonction qui permet à l'utilisateur de choisir une couleur

function chooseColor(){

    // Code à exectuer lorsque la fonction est appelée
    var userPrompt = prompt('Choisir une couleur entre rouge, vert et bleu'); 

    // Appeler la fonction de traduction
    translateColor( userPrompt );
};

// Créer une fonction pour traduire les couleurs
function translateColor( paramColor ){
    // Lorsqu'on crée une nouvelle fonction on est obligée de passer par le "function" alors que pour Switch, il s'agit d'une fonction native de js, donc pas besoin de la nommer
    // Utilisation du switch
    switch(paramColor){  // Switch est une fonction, paramColor est un paramètre de la fonction

        // 1er cas : paramColor est égale à 'rouge'
        case 'rouge' : console.log('Rouge = Red'); break; 
        
        // 2ème cas : paramColor est égale à 'vert'
        case 'vert' : console.log('Vert = Green'); break;

        // 3ème cas : paramColor est égale à 'bleu'
        case 'bleu' : console.log('Bleu = Blue'); break;

        // Pour tous les autres cas : default est OBLIGATOIRE
        default : console.log('Je ne connais pas cette couleur'); break;


    }
};