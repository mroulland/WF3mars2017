<?php
/* 
   Vous créez un tableau PHP contenant les pays suivants : France, Italie, Espagne, inconnu, Allemagne auxquels vous associez les valeurs Paris, Rome, Madrid, blablabla, Berlin.

   Vous parcourez ce tableau pour afficher la phrase "La capitale X se situe en Y" dans un paragraphe (où X remplace la capitale et Y le pays).

   Pour le pays "inconnu" vous afficherez "Ca n'existe pas !" à la place de la phrase précédente. 	


*/


$capitales = array('France' => 'Paris', 'Italie' => 'Rome', 'Espagne' => 'Madrid', 'inconnu' => 'blablabla', 'Allemagne' => 'Berlin'); 

echo '<pre>'; print_r($capitales); echo '</pre>';



foreach($capitales as $pays => $capitale){
    if($pays == 'inconnu'){
        echo '<div>Ca n\'existe pas !</div>';

    } else{
        echo '<div>La capitale '. $capitale .' se situe en '. $pays .'</div>';
    }
}



