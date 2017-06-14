$(document).ready(function(){

    console.log('DOM ok');

    // Capter le clic sur le premier bouton
    $('button:first').click(function(){

        // Charger le contenu de views/about.html dans la première section du main
        $('section').eq(0).load('views/about.html', function(){ // La fonction load est une fonction qui permet de charger le contenu d'une page vers une destination. On cible la destination au début, et on indique à l'intérieur de la fonction le chemin du document à charger
            // Fonction de callBack de la fonction load. La fonction callBack arrive après que la fonction load se soit bien déroulée ! 
            console.log('Le fichier about.html est chargé')

            // Animer la première section
            $('section').eq(0).fadeIn();  // L'animation se lance une fois que le document est chargé, l'animation se lance. Voilà à quoi sert la fonction callBack
        }); 
    });

    // Capter le clic du deuxième bouton
    $('button').eq(1).click(function(){

        // Charger dans la deuxième section le contenu de content.html
        $('section').eq(1).load('views/content.html #portfolio');

    });

    $('button').eq(2).click(function(){

        $('section').eq(2).load('views/content.html #contacts', function(){
            // Appeler la fonction submitForm
            submitForm();

        });
    });

    // Créer une fonction pour capter la soumission du formulaire
    function submitForm(){

        // Capter la soumission du formulaire
        $('form').submit(function(evt){

            // Créer une variable pour la validation finale du formulaire
            var formScore = 0;

            // Bloquer le comportement par défault du formulaire
            evt.preventDefault();

            console.log('submit du formulaire');

            // Minimum 4 caractères pour l'email et 5 caractères pour le message
            if($('[type="email"]').val().length < 4){ 
                console.log('Email manquant');

            } else{
                console.log('Email OK')
                formScore++;
            };

            if($('textarea').val().length < 5){
                console.log('Minimum 5 caractères');

            } else{
                console.log('Message OK');
                formScore++;
            };

            // Vérifier la valeur de formScore
            if(formScore == 2){
                console.log('Formulaire validé');

                // => envoie des données vers le fichier de traitement PHP
                    // => le fichier PHP répondu true : je peux continuer mon code


                    // Envoyer le contenu du message et du formulaire dans la balise aside
                    $('aside').append('<h3>' + $('textarea').val() + '</h3><p>' + $('[type="email"]').val() + '</p>'); // .append ajoute le contenu dans l'Html contrairement à .html/.text qui remplace le contenu d'une balise par un autre


                    // Reset du formulaire
                    $('form')[0].reset();


            };


        });
    };



}); // Fin de la fonction d'attente du chargement du DOM