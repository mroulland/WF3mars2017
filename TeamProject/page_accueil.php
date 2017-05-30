<?php

require_once('inc/init.inc.php');

// Déclaration des variables de traitement du formulaire : 
$cat = '';
$ville = '';
$capacite = '';
$prix = '';
$date_arrivée = '';
$date_depart = ''; 


// ----------- AFFICHAGE DES CATEGORIES ------------ //
    
    // Affichage des categories
    $categories = executeRequete("SELECT DISTINCT categories FROM salle");

    // $contenu_gauche .= '<form method="get">';
    $contenu_gauche .= '<label>Catégorie</label>';
        while($cat = $categories->fetch(PDO::FETCH_ASSOC)){
            $contenu_gauche .= '<div class="abra"><a href="?categories='. $cat['categories'] .'"> '. $cat['categories'] .' </a></div class="abra">';
        }


    // Affichage des villes : 
    $villes = executeRequete("SELECT DISTINCT ville FROM salle");

    $contenu_gauche .= '<label>Ville</label>';
        while($ville = $villes->fetch(PDO::FETCH_ASSOC)){
            $contenu_gauche .= '<div class="abra"><a href="?ville='. $ville['ville'] .'"> '. $ville['ville'] .' </a></div>';
        }


    // // Capacité : 
    // $capacite = executeRequete("SELECT DISTINCT capacite FROM salle ORDER BY capacite");

    // $contenu_gauche .= '<label>Capacité</label>';
    // $contenu_gauche .= '<select name="capacite" onchange="ajax()">';
    //     while($nombre = $capacite->fetch(PDO::FETCH_ASSOC)){
    //         $contenu_gauche .= '<option value="'.$nombre['capacite'].'">'.  $nombre['capacite'].' personnes</option>';
    //     }
    // $contenu_gauche .= '</select>';


    // // Prix : 
    // $prix = executeRequete("SELECT DISTINCT prix FROM produit ORDER BY prix");

    // $contenu_gauche .= '<label>Prix</label>';
    // $contenu_gauche .= '<select name="prix" onchange="ajax()">';
    //     while($montant = $prix->fetch(PDO::FETCH_ASSOC)){
    //         $contenu_gauche .= '<option value="'.$montant['prix'].'">'.  $montant
    //         ['prix'].'€</option>';
    //     }
    // $contenu_gauche .= '</select>';

    // // Période
    // $contenu_gauche .= '<label for="date_arrivee">Date d\'arrivée</label>';
    // $contenu_gauche .= '<input type="date" name="date_arrivee">';

    // $contenu_gauche .= '<label for="date_depart">Date de départ</label>';
    // $contenu_gauche .= '<input type="date" name="date_depart">';

    // $contenu_gauche .= '<input type="submit" value="Envoyer">';
    // $contenu_gauche .= '</form>';



// ----------- AFFICHAGE DES PRODUITS ------------ //

    // TRAITEMENT DU FORMULAIRE DE RECHERCHE
    // if(isset($_POST));


    // AFFICHAGE DES PRODUITS DEMANDES 

    if(empty($_GET)){
        $query = executeRequete("SELECT salle.*, produit.* FROM produit INNER JOIN salle ON produit.id_salle = salle.id_salle"); // pas de clause where parce qu'on veut tous les produits concernés
        // $resultat = $query->fetch(PDO::FETCH_ASSOC);
        // print_r($resultat);
    } else{
        if(isset($_GET['categories'])){
            $query = executeRequete("SELECT salle.*, produit.* FROM produit INNER JOIN salle ON produit.id_salle = salle.id_salle WHERE salle.categories = :categories", array(':categories' => $_GET['categories'])); 

        }elseif(isset($_GET['ville'])){
            $query = executeRequete("SELECT salle.*, produit.* FROM produit INNER JOIN salle ON produit.id_salle = salle.id_salle WHERE salle.ville = :ville", array(':ville' => $_GET['ville'])); 
        }
    }


    while($produits = $query->fetch(PDO::FETCH_ASSOC)){
        $contenu_droit .= '<div class="fichette">'; 
            $contenu_droit .= '<a href="fiche_produit.php?id_produit='. $produits['id_produit'].'"><img src="'.$produits['photo'].'" alt="" width="100%"></a>';

            $contenu_droit .= '<div class="details"><h4 class="titre">'.$produits['titre'].'</h4>'; 
            $contenu_droit .= '<h4>'. $produits['prix'] .' €</h4>';

            $contenu_droit .= '<p class="description">' . substr($produits['description'], 0, 105) . ' ...</p> ';

            $date_arrivee = new DateTime($produits['date_arrivee']);
            $date_arrivee = $date_arrivee->format('d/m/Y');

            $date_depart = new DateTime($produits['date_depart']);
            $date_depart = $date_depart->format('d/m/Y');

            $contenu_droit .= '<div><i class="fa fa-calendar" aria-hidden="true"></i>Du '. $date_arrivee .' au '. $date_depart .'</div>';
            $contenu_droit .= '<p class="search"><a href="fiche_produit.php?id_produit='. $produits['id_produit'] . '"><i class="fa fa-search" aria-hidden="true"></i>Voir</a></p>';
        
        $contenu_droit .= '</div></div>';
    }


require_once('inc/haut.inc.php');

?>





<style>
#gauche{
    display: inline-block;
    width: 10%;
    margin-right: 10rem;
    text-align: center;
}

#droit{
    display: inline-block;
    width: 80%;
    vertical-align: top;
    margin-top: 2rem;

}

.fichette{
    display: inline-block;
    vertical-align: top;
    min-height: 36rem;
    width: 30%;
    border: 1px solid black;
    margin: 1rem;
}

.fichette img{
    max-height: 20rem;
}

h4{
    display:inline-block;
}

.titre{
    padding-right: 4rem;
}

.description{
    text-align: justify;
    margin-bottom: 1rem;
}

.details{
    padding: 2rem;
}

.search{
    text-align: right;
    margin-top: 1rem;
}

.abra{
    border: 0.1rem solid black;
    padding: 1rem;
}

.abra a{
    text-decoration : none;
    color: grey;
}

input, select, label{
    width: 100%;
    display: block;
}

label{
    margin: 2rem 0 1rem 0;
}

section{
    
    margin-bottom: 5rem;
}

</style>
    <section id="gauche">
        <?php echo $contenu_gauche; ?>
    </section>

    <section id="droit">
        <?php echo $contenu_droit; ?>
    </section>

    <p><a href="avis.php">Déposer un commentaire et une note</a></p>

<?php 
// Affichage HTML



















require_once('inc/bas.inc.php');
