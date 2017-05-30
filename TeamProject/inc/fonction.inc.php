<?php

// ******** Fonction membres ******** // 
function connected(){
    // fonction pour déterminer si l'internaute est connecté
    if(isset($_SESSION['membre'])){
        return true;
    } else { 
        return false;
    }
}

function connectedAdmin(){
    // fonction pour déterminer si l'internaute est connecté et est admin
    if(connected() && $_SESSION['membre']['statut'] == 1){
        return true;
    } else {
        return false;
    }
}

// ******** Fonction exécution requêtes SQL ******** //

function executeRequete($req, $param = array()){
    // $param est un array vide, donc optionnel, qui servira à passer les marqueurs en paramètres de la fonction

    // Traitement htmlspecialchars : 
    // (si il y a des paramètres, on les traite)
    if(!empty($param)){
        foreach($param as $indice => $value){
            $param[$indice] = htmlspecialchars($value, ENT_QUOTES); // transforme en entité html chaque caractères spéciaux
        }
    }

    // Requête préparée
    global $pdo;
    $r = $pdo->prepare($req);
    $succes = $r->execute($param);

    // Traitement des erreurs
    if(!$succes){
        die('Erreur de la requête SQL : ' . $r->errorInfo()[2]);
    }

    return $r; // retourne un objet PDOStatement qui contient le résultat de la requête. 
}

