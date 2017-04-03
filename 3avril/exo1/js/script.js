// Attendre le chargment du DOM

$(document).ready(function(){


    // Créer un tableau vide pour enregistrer les avatars
    var myTown = [];



    // Vérifier le genre de l'avatar    (On sort ces variables de la soumission du formulaire car le click est soumis à la validation du formulaire sinon, hors il faut que le click soit capté avant la soumission dans ce cas)
        var avatarWoman = $('#avatarWoman');
        var avatarMan = $('#avatarMan');
        var avatarGender;

        // => avatarWoman capter le click
        avatarWoman.click(function(){

            // Désactiver avatarMan
            avatarMan.prop('checked', false);

            // Modifier la valeur de avatarGender
            avatarGender = avatarWoman.val(); // => girl

            // Vider le message d'erreur
            $('.labelGender b').text('');

            // Modifier l'attribut src de #avatarBody
            $('#avatarBody').attr('src', 'img/' + avatarGender + '.png');

        });

        // => avatarMan capter le click
        avatarMan.click(function(){
        
            // Désactiver avatarWoman
            avatarWoman.prop('checked', false);

            // Modifier la valeur de avatarGender
            avatarGender = avatarMan.val();

            // Vider le message d'erreur
            $('.labelGender b').text('');

            // Modifier l'attribut src de #avatarBody
            $('#avatarBody').attr('src', 'img/' + avatarGender + '.png');

        });

        
    // Supprimer les messages d'erreur
    $('input, select').focus(function(){

        // Sélectionner la balise précédent le input
        $(this).prev().children('b').text('');
    });


    // Capter l'évènement change() sur les selects
    $('select').change(function(){

        console.log( $(this).attr('id'), ' change : ' + $(this).val() ); // La diff entre le + et la , tient dans l'opération qu'on veut faire. Il essaye de concaténer deux strings, il affichera seulement "objet" alors qu'avec la virgule on obtient le détail de l'objet en question et non la tentative de cumulation des deux
    
        // Condition if pour modifier la valeur src de avatarTop ou avatarStyleBottom
        if($(this).attr('id') == 'avatarStyleTop'){
            console.log('Modification du style top');

            // Modifier la valeur de l'attribut src de #avatarTop
            $('#avatarTop').attr('src', 'img/top/' + $(this).val() + '.png');


        } else{ 
            console.log('Modification du style bottom');
            $('#avatarBottom').attr('src', 'img/bottom/' + $(this).val() + '.png');
        };


    });


    // Capter la soumission du formulaire dans la page
    $('form').submit( function(evt){

        //  Bloquer le comportement par défaut du formulaire 
            evt.preventDefault();

        // Définir une variable pour la validation finale du formulaire
            var formScore = 0;


        // Variables globales
            var avatarName = $('#avatarName').val();
            var avatarAge = $('#avatarAge').val();

            var avatarStyleTop = $('#avatarStyleTop').val();
            var avatarStyleBottom = $('#avatarStyleBottom'). val();

        // Vérifier les champs du formulaire
            //  => avatarName minimum 5 caractères
            if(avatarName.length < 5 ){

                // Ajouter un message d'erreur dans le label du dessus
                $('[for="avatarName"] b').text(' Minimum 5 caractères');

            } else{
                // Incrémenter la variable formScore
                formScore++;
            };

            // => avatarAge entre 0 et 100
            if(avatarAge == 0 || avatarAge > 100 || avatarAge.lengh == 0 ){
                $('[for="avatarAge"] b').text(' Entre 1 et 100');

            } else{
                formScore++;
            };

            // => avatarStyleTop obligatoire
            if(avatarStyleTop == 'null'){
                $('[for="avatarStyleTop"] b').text(' Vous devez choisir un style en haut');

            } else{
                formScore++;
            };
     
            // => avatarStyleBottom obligatoire
            if(avatarStyleBottom == 'null'){
                $('[for="avatarStyleBottom"] b').text(' Vous devez choisir un style en bas');
                
            } else{
                formScore++;
            };

            // => avatarGender vérifier la valeur
            if( avatarGender == undefined ){
                $('.labelGender b').text(' Vous devez choisir un genre');
            
            } else{
                formScore++;
            }


        //  Validation finale : vérifier la valeur de la variable formScore
            if(formScore == 5){
                console.log('Le formulaire est validé !')

                // => Envoyer les données du formulaire et attendre la réponse du serveur en Ajax
                // => Le serveur répond true

                    // Ajouter une ligne dans le tableau HTML
                    $('table').append('' + 
                        '<tr>' +
                            '<td><b>' + avatarName + '</b></td>'+
                            '<td>' + avatarAge + 'an(s) </td>'+
                            '<td>' + avatarGender + '</td>' +
                            '<td>' + avatarStyleTop + ',' + avatarStyleBottom + '</td>' +
                        '</tr>'
                    );

                    // Ajouter l'avatar dans le tableau JS
                    myTown.push({
                        name: avatarName,
                        gender: avatarGender,
                        age: parseInt(avatarAge), // Permet de transformer la valeur en entier
                        top: avatarStyleTop,
                        bottom: avatarStyleBottom
                    }); // On fait toujours un tableau d'objets quand on a de nombreuses caractéristiques à récupérer. Aussi appeler un "Jason"



                    // On vide alors les champs du formulaire
                    $('form')[0].reset();
                    // Form de base va donner un tableau contenant les différents form (même s'il n'y en a qu'un), il faut donc lui indiquer qu'on veut afficher le premier tableau, numéroté 0

                    // Revenir aux valeurs 'null' pour l'avatar
                    $('#avatarBody').attr('src', 'img/null.png');
                    $('#avatarTop').attr('src', 'img/top/null.png');
                    $('#avatarBottom').attr('src', 'img/bottom/null.png');

                    // Afficher les données du tableau JS dans la console
                    console.log( myTown.length );
                    
                    // Afficher la taille totale de la vielle dans #totalSims
                    $('#totalSims').text( myTown.length);
                    // $('#simsWoman b, #simsMan b').text('/'+ myTown.length);

                    // Définir les variables gloables pour les statistiques
                    var totalGirls = 0;
                    var totalBoys = 0;
                    var totalAge = 0;


                    // Faire une boucle for sur myTown pour connaître les statistiques
                    for(i=0; i < myTown.length; i++){

                        console.log( myTown[i].gender );

                        // Condition pour le genre
                        if( myTown[i].gender == 'girl'){
                            totalGirls++;

                        } else{
                            totalBoys++;
                        };

                        // Additionner les âges
                        totalAge += myTown[i].age;

                    };
             
                    //  Afficher dans le tableau HTML le nombre de girls et le nombre de boys
                    $('#simsWoman').html(totalGirls + ' <b>/' + myTown.length + '</b>');
                    $('#simsMan').html(totalBoys + ' <b>/' + myTown.length + '</b>'); 

                    // Afficher l'âge total dans la console
                    console.log(totalAge / myTown.length); 
                    var ageAmountRounded = Math.round(totalAge / myTown.length);

                    $('#simsAgeAmount').html(ageAmountRounded + ' <b>ans</b>');



            };
            

    

    });


}); // Fin de la fonction d'attente de chargement du DOM