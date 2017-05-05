<?php 
/* 

    1 - Créer une fonction qui retourne la conversion d'une date FR en date US ou inversement. 
    Cette fonction prend 2 paramètres : une date (valide) et le format de conversion "US" ou "FR"

    2 - Vous validez que le paramètre de format est bien "US" ou "FR". la fonction retourne un message si ce n'est pas le cas. 

*/

$date='';
$format='';

// Déclaration de la fonction de transformation : 

function conversionDate($date, $format){

    switch($format){
        case 'US' : echo strftime('%Y-%m-%d', strtotime($date)) . '<br>'; break;
        case 'FR' : echo strftime('%d-%m-%Y', strtotime($date)) . '<br>'; break;
        default : echo 'Je ne connais pas ce format';
    }
}


function conversionDate2($date, $format){

    $date2 = explode('-', $date);
    echo '<pre>'; print_r($date2); echo '</pre>';

    if($format == 'US'){
        if(isset($date2[0]) && isset($date2[1]) && isset($date2[2]) && checkdate($date2[1], $date2[0], $date2[2])){
            echo strftime('%Y-%m-%d', strtotime($date)) . '<br>';
        } else {
            echo 'Il y a un problème avec la date ... ';
        }
    }

    elseif($format == 'FR'){
        if(isset($date2[0]) && isset($date2[1]) && isset($date2[2]) && checkdate($date2[1], $date2[2], $date2[0])){
            echo strftime('%d-%m-%Y', strtotime($date)) . '<br>'; 

        } else {
            echo 'Il y a un problème avec la date ... ';
        }
    }

    else{
        echo 'Je ne connais pas ce format';
    }
}




conversionDate2('18-06-1991', 'US');
conversionDate2('2017-05-20', 'FR');
