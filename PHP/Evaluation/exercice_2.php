<?php

echo "<h1>On part en voyage</h1>";

// Création de la fonction conversion 

function conversion($montant, $devise){

    // Vérification du champs montant
    if($montant > 0 && is_int($montant) || is_float($montant)){

        // Vérification du champ devise
        if($devise == 'EUR'){
            $montantConverti = round($montant/1.085965, 2);
            echo "<div>$montant dollars  = $montantConverti euros</div>";

        } elseif($devise == 'USD') {
            $montantConverti = round($montant*1.085965, 2);
            echo "<div>$montant euros  = $montantConverti dollars américains</div>";

        } else{
            echo "<div>La devise indiquée n'est pas valide.</div>";
        }

    } else {
        echo "<div>Le montant indiqué est incorrect.</div>";
    }
}

// Phase de test de la fonction :

conversion(100, 'USD');
conversion(100, 'EUR');
conversion(-100, 'USD');
conversion('lgkd', 'EUR');
conversion(100, 'YEN');

?>