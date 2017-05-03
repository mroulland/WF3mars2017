<?php 


// ****************** Fonctions membres ****************** //
function internauteEstConnecte() {
    // Cette fonction indique si l'internaute est connecté : si la session 'membre' est définie, c'est que l'internaute est passé par la page de connexion avec le bon mdp
    if (isset($_SESSION['membre'])) {
        return true;
    } else  {
        return false;
    }

    // on pourrait écrire : 
    // return isset ($_SESSION['membre']); car isset retourne déjà true ou false
}

//------------
function internauteEstConnecteEtEstAdmin() {
    // Cette fonction indique si le membre connecté est admin
    if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) {
        return true;
    } else {
        return false;
    }
}


//------------

function executeRequete($req, $param = array()) { // $param est un array vide par défaut, il est donc optionnel. Parfois sur certaines fonctions, nous n'aurons pas de marqueurs à utiliser dans $param, or tous les paramètres d'une fonction sont obligatoires, on rend donc ce paramètre optionnel en lui indiquant un array vide.  

    // htmlspecialchars : 
    if (!empty($param)){
        // Si on a bien reçu un array, on le traite : 
        foreach($param as $indice => $valeur) {
            $param[$indice] = htmlspecialchars($valeur, ENT_QUOTES); // transforme en entités HTML chaque caractères spéciaux dont les quotes. 
        }
    }

    // La requête préparée :
    global $pdo; // $pdo est déclarée dans l'espace global (fichier init.inc.php). Il faut donc faire global $pdo pour l'utiliser dans l'espace local de cette fonction. 
    $r = $pdo->prepare($req);
    $succes = $r->execute($param);  // on exécute la requête en lui passant l'array $param qui permet d'associer chaque marqueur à sa valeur

    // Traitement erreur SQL éventuelle : 
    if (!$succes) {  // si $succes vaut false, il y a une erreur sur la requête
        die('Erreur sur la requête SQL : ' . $r->errorInfo()[2] );  // die arrête le script et affiche un message. Ici, on affiche le message d'erreur SQL donné par errorInfo(). Cette méthode retourne un array dans lequel le message se situe à l'indice [2]. 
    }
    
    return $r; // retourne un objet PDOStatement qui contient le résultat de la requête. 
} 



// ********************************* Fonctions du panier ********************************* // 

function creationDuPanier() {
    if(!isset($_SESSION['panier'])){
        // si il n'existe pas déjà un panier dans $_SESSION, on le crée : 
        $_SESSION['panier'] = array();  // le panier est un array vide. 
        $_SESSION['panier']['titre'] = array();
        $_SESSION['panier']['id_produit'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();
    }
}

function ajouterProduitDansPanier($titre, $id_produit, $quantite, $prix) { // les arguments sont en provenance de panier.php 


}
?>