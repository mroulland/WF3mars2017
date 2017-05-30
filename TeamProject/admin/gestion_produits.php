<?php
require_once('../inc/init.inc.php');




// ------------------------------ TRAITEMENT ----------------------------------

//  verification ADMIN
if(!connectedAdmin()){
    header('location:../connexion.php'); // si membre pas ADMIN, alors on le redirige vers la page de connexion qui est à la racine du site (en dehors du dossier admin)
    exit();

}

// suppression d'un produit
if (isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_salle'])){

    // puis suppression du produit en BDD:
    executeRequete("DELETE FROM produit WHERE id_salle = :id_salle", array(':id_salle' => $_GET['id_salle']));

    $contenu .= '<div class="suppression">Le produit a été supprimé !</div>';
    $_GET['action'] = 'affichage'; // pour lancer l'affichage des produits dans le tableau HTML

}else{
    $resultat = executeRequete("SELECT * FROM produit");
    
}

$contenu .= '<h3>Liste des produits</h3>
                <table border=".2rem solid grey">';
  
        // La ligne des entêtes
        
        $contenu .= '<tr>';

            for($i = 0; $i < $resultat->columnCount(); $i++){
                $colonne = $resultat->getColumnMeta($i);
            
                 $contenu .= '<th>' . $colonne['name'] . '</th>'; //getColumnMeta() retourne un array contenant notamment l'indice name contenant le nom de la colonne
            }
            
            $contenu .='<th>Action</th>'; // on ajoute une colonne "action"

        $contenu .= '</tr>';
        
        // Affichages des lignes

        while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
            $contenu .= '<tr>';
                // echo '<pre>'; print_r($ligne), echo '<pre>';
                foreach($ligne as $index => $data){
                        $contenu .= '<td>' . $data . '</td>';
                }
        

                $contenu .= '<td>
                                <a href="?action=modification&id_produit='. $ligne['id_produit'] .'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> /
                                <a href="?action=suppression&id_produit=' . $ligne['id_produit'] . '"
                                onclick="return(confirm(\'Etes-vous cetain de vouloir supprimer ce produit ? \'));"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>';
        
            $contenu .= '</tr>';


        }
    
    $contenu .= '</table>';




// ------------------------------ AFFICHAGE -----------------------------------

require_once('../inc/haut.inc.php');
echo "<a href='?action=affichage'>Afficher les produits</a>";
echo "<a href='?action=ajout'>Ajouter les produits</a>";
echo $contenu;

// 3- Formulaire HTML
if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')) :
// Si on a demandé l'ajout d'un produit ou sa modification , on affiche le formulaire : 

    // 8 - formulaire de modification avec présaisie des infos dans le formulaire : 
    if(isset($_GET['id_produit'])){
        //Pour pré remplir le formulaire on requête en BDD les infos du produit passé dans l'url : 
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

        $produit_actuel = $resultat->fetch(PDO::FETCH_ASSOC); // pas de while car un seul produit 
    
    }

?>


<h3>Formulaire d'ajout ou de modification d'un produit</h3>
<form method="post" action="">

    <label for="date_arrivee">Date d'arrivee</label>
    <input type="date" id="date_arrivee" name="date_arrivee" value="<?php echo $produit_actuel['date_arrivee'] ?? ''; ?>"><br><br>

    <label for="date_depart">Date de depart</label>
    <input type="date" id="date_depart" name="date_depart" value="<?php echo $produit_actuel['date_depart'] ?? ''; ?>"><br><br>

    <label for="tarif">Tarif</label>
    <input type="text" id="tarif" name="tarif" value="<?php echo $produit_actuel['tarif'] ?? ''; ?>"><br><br>

    <label for="salle">Salle</label>
    
    <select>
    <?php
        $liste = executeRequete("SELECT titre, adresse, cp, ville, capacite FROM salle");

        while($liste_resultat = $liste->fetch(PDO::FETCH_ASSOC)){
                echo '<option value="'. $liste_resultat['titre'] .'">' . $liste_resultat['titre'] . ' - ' . $liste_resultat['adresse'] . ', ' . $liste_resultat['cp'] . ', ' . $liste_resultat['ville'] .  ' - ' . $liste_resultat['capacite'] . ' personnes </option>';

        }

    ?>
    </select>

    <input type="submit" value="valider" class="btn">

    </form>

<?php

endif;

require_once('../inc/bas.inc.php');


