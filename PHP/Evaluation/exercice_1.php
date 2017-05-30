<?php

// Création du tableau $presentation contenu les index et les valeurs 

$presentation = array('Prénom' => 'Morgane', 'Nom' => 'Roulland', 'Adresse' => '3, rue du pavillon bleu', 'Code Postal' => '92350', 'Ville' => 'Le Plessis Robinson', 'Email' => 'morgane.roulland@hotmail.fr', 'Téléphone' => '0698513166', 'Date de naissance' => '1991-06-18');

// echo '<pre>'; print_r($presentation); echo '</pre>';

echo '<h1>Exercice 1 - On se présente !</h1>';

//  Boucle foreach pour parcourir les données du tableau

echo '<ul>';

foreach ($presentation as $key => $value){
    if($key == 'Date de naissance'){

        // Transformer la date avec la classe objet DateTime :
        $value = new DateTime($value);
        $date = $value->format('d-m-Y');

        // Ou deuxième possibilité avec la fonction strftime : 
        // $date = strftime ('%d-%m-%Y', strtotime($value));

        echo "<li>$key : $date</li>";

    } else{
        echo "<li>$key : $value</li>";
    } 

}

echo '</ul>';

?>