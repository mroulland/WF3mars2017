<?php
require_once('inc/init.inc.php');

// ---------------------------- TRAITEMENT ---------------------------------
//si visiteur non connecté, on l'envoie vers connexion.php
if(!connected()){ 
    header('location:connexion.php'); //nous l'invitons à se connecter
    exit();
}

if($_SESSION['membre']['civilite'] == 'm'){
    $civilite = 'Monsieur';
}else{
    $civilite = 'Madame';
}

$contenu .= '<h2>Bonjour ' . $civilite . ' ' . $_SESSION['membre']['pseudo'] . ' ! </h2>';


// On affiche le statut du membre 
if($_SESSION['membre']['statut'] == 1){
    $contenu .= '<p>Vous êtes un administrateur</p>';
}else{
    $contenu .= '<p>Vous êtes un membre</p>';  
}

$contenu .= '<div><h3>Voici vos informations de profil</h3>';
    $contenu .= '<p>Votre email :'. $_SESSION['membre']['email'] . '</p>';
$contenu .= '</div>';


$suiviCommande = executeRequete("SELECT id_commande, date_enregistrement FROM commande WHERE id_membre = :id_membre", array(':id_membre' => $_SESSION['membre']['id_membre']));

if($suiviCommande->rowCount() > 0){

    $contenu .= '<ul>';
        while($resultat =  $suiviCommande->fetch(PDO::FETCH_ASSOC)){

        //echo '<pre>'; print_r($resultat); echo '</pre>'; // ici mon objet PDO Statement $suiviCommande est bien transformé en array grâce au fetch

                $contenu .='<li>';
                    $contenu .=  '<p>Votre numero de commande est le ' . $resultat['id_commande'] . '</p>';
                    $contenu .=  '<p>La commande a été passée le ' . $resultat['date_enregistrement'] . '</p>';
                $contenu .= '</li>';
        }
    $contenu .= '</ul>';
}else{
    $contenu .= "<p>Aucune commande en cours</p>";
    }
    




// ---------------------------- AFFICHAGE ----------------------------------
require_once('inc/haut.inc.php');
echo $contenu;
require_once('inc/bas.inc.php');