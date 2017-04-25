<h1>Couleur du fruit</h1>

<?php

// Exercice : 
/*
    - Dans le fichier listeFruits.php : créer trois liens banane, kiwi et cerise. Quand on clique sur les liens, on passe le nom du fruit dans l'URL à la page couleur.php. 
    
    - Dans couleur.php : vous récupérez le nom du fruit et affichez sa couleur. 
    
    Notez que vous ne passez pas la couleur dans l'URL mais vous la déduisez dans couleur.php.  
*/


// Vérifier que 'fruit' existe, avant d'afficher la couleur correspondante

if(isset($_GET['fruit'])){
    echo "La couleur de $_GET[fruit] est : ";

    if($_GET['fruit'] == 'banane'){
        

    } elseif ($_GET['fruit'] == 'kiwi'){
        echo 'vert';

    } elseif ($_GET['fruit'] == 'cerise'){
        echo 'rouge';
    }

} else {
    echo 'Aucun fruit sélectionné';
}


echo '<br> <br>';

if(isset($_GET['fruit'])){
    echo "La couleur de $_GET[fruit] est : ";

    switch ($_GET['fruit']){
        case 'banane' : echo 'jaune'; break;
        case 'kiwi' : echo 'vert'; break;
        case 'cerise' : echo 'rouge'; break;
        default : echo 'Ce fruit n\'existe pas';
    }

} else {
    echo 'Aucun fruit sélectionné';
}
