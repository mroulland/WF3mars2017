<?php 
require_once('../inc/init.inc.php');

// ***** TRAITEMENT ***** //

// Redirection du membre si il n'est pas admin
if(!connectedAdmin()){
    header('location:../connexion.php');
    exit();
}


// Suppression d'un produit
if(isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['id_salle'])){
    
    // On séléctionne en bdd la photo
    $resultat = executeRequete("SELECT photo FROM salle WHERE id_salle = :id_salle", array(':id_salle' => $_GET['id_salle'])); 

    $salle_a_supprimer = $resultat->fetch(PDO::FETCH_ASSOC); // un seul produit concerné

    $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $salle_a_supprimer['photo']; // chemin du fichier à supprimer

    if (!empty($salle_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer) ){
        // Si il y a un chemin de photo en base ET que le fichier existe, on peut le supprimer : 
        unlink($chemin_photo_a_supprimer);  // supprime le fichier spécifié 
    }

    // Puis suppression du produit en BDD : 
    executeRequete("DELETE FROM salle WHERE id_salle = :id_salle", array(':id_salle' => $_GET['id_salle']));

    $contenu .= '<div class"bg-success">La salle a été supprimé !</div>';
    $_GET['action'] = 'affichage';  // pour lancer l'affichage des produits dans le tableau HTML 
}


// Vérification du formulaire
if(!empty($_POST)){ // si le formulaire est posté

    // Validation du formulaire : 
    if(strlen($_POST['titre']) < 2 || strlen($_POST['titre']) > 20){
        $contenu .= '<div>Le titre doit contenir au moins 2 caractères</div>';
    }

    if(strlen($_POST['description']) < 10){
        $contenu .= '<div>La description doit contenir au moins 10 caractères</div>';
    }

    if(strlen($_POST['pays']) < 2){
        $contenu .= '<div>Le pays doit contenir au moins 2 caractères</div>';
    }

    if(strlen($_POST['ville']) < 2){
        $contenu .= '<div>La ville doit contenir au moins 2 caractères</div>';
    }

    if(strlen($_POST['adresse']) < 10){
        $contenu .= '<div>L\'adresse doit contenir au moins 10 caractères</div>';
    }

    if(!preg_match('#^[0-9]{5}$#', $_POST['cp'])){
        $contenu .= '<div>Le code postal n\'est pas valide</div>';
    }

    if(is_int($_POST['capacite'])){
        $contenu .= '<div>La capacité n\'est pas valide</div>';
    }

    if($_POST['categories'] != 'reunion' && $_POST['categories'] != 'bureau' && $_POST['categories'] != 'formation'){
        $contenu .= '<div>La catégorie n\'est pas séléctionnée</div>';
    }

    // Traitement de la photo
    $photo_bdd = '';
    if(isset($_GET['action']) && $_GET['action'] == 'modifier'){
        $photo_bdd = $_POST['photo_actuelle'];
    }



    if(!empty($_FILES['photo']['name'])){ 
        // On crée le nom de la photo uploadée
        $nom_photo = $_POST['titre'] . '_' . $_FILES['photo']['name'];

        // on constitue de le chemin de la photo enregistrée en BDD
        $photo_bdd = RACINE_SITE . 'photos/' . $nom_photo; 

        // chemin du serveur 
        $photo_dossier = $_SERVER['DOCUMENT_ROOT'] . $photo_bdd; 
        

        copy($_FILES['photo']['tmp_name'], $photo_dossier); // on copie le fichier temporaire de la photo stockée au chemin indiqué par $_FILES dans le dossier de notre serveur
    }

    if(empty($contenu)){
        executeRequete("REPLACE INTO salle (id_salle, titre, description, photo, pays, ville, adresse, cp, capacite, categories) VALUES (:id_salle, :titre, :description, :photo, :pays, :ville, :adresse, :cp, :capacite, :categories)", array(':id_salle' => $_POST['id_salle'], ':titre' => $_POST['titre'], ':description' => $_POST['description'], ':photo' => $photo_bdd, ':pays' => $_POST['pays'], ':ville' => $_POST['ville'], ':adresse' => $_POST['adresse'], ':cp' => $_POST['cp'], ':capacite' => $_POST['capacite'], ':categories' => $_POST['categories']));

        $contenu .= '<div>Le produit a été correctement enregistré. </div>'; 
        $_GET['action'] = 'affichage'; 
    }

}

// Affichage des salles : 
// On récupère la commande 'affichage'

if(isset($_GET['action']) && $_GET['action'] == 'affichage' || !isset($_GET['action'])){ 
    $resultat = executeRequete("SELECT * FROM salle"); 

    $contenu .= '<h3>Liste des salles</h3>
                <table border=".2rem solid grey">';

            // Affichage des entêtes : 
            $contenu .= '<tr>';
                for($i = 0; $i < $resultat->columnCount(); $i++){
                    $colonne = $resultat->getColumnMeta($i);
                    $contenu .= "<th> $colonne[name] </th>";
                }

                // On rajoute une colonne action :
                $contenu .= '<th>Action</th>';
            $contenu .= '</tr>';
            
            // Affichage des lignes 
            while ($salle = $resultat->fetch(PDO::FETCH_ASSOC)){
            $contenu .= '<tr>';
                            foreach($salle as $index => $value){
                                if($index == 'photo'){
                                    $contenu .= '<td><img src="'.$value.'" alt="image de la salle" width="70" height="70"></td>'; 
                                } else{
                                    $contenu .= '<td>'. $value .'</td>';
                                } 
                            } // fin du foreach

                $contenu .= '<td>
                                <a href="?action=fiche_produit&id_salle='. $salle['id_salle'] .'"><i class="fa fa-search" aria-hidden="true"></i></a>
                                <a href="?action=modifier&id_salle='. $salle['id_salle'] .'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>
                                <a href="?action=supprimer&id_salle='. $salle['id_salle'] .'" onclick="return(confirm(\'Êtes-vous certain de vouloir supprimer ce produit ?\'));"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>';
        }
                
    $contenu .= '</table>';
}

require_once('../inc/haut.inc.php');
echo $contenu;

// Pour la modification, on demande l'affichage des informations dans les champs en question 

if(isset($_GET['action']) && $_GET['action'] == 'modifier' && isset($_GET['id_salle'])){
        $resultat = executeRequete("SELECT * FROM salle WHERE id_salle = :id_salle", array(':id_salle' => $_GET['id_salle']));

        $produit_actuel = $resultat->fetch(PDO::FETCH_ASSOC); 
}

?>

<h2>Gestion des salles</h2>

<form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" id="id_salle" name="id_salle" value="<?php echo $produit_actuel['id_salle'] ?? 0; ?>">
    <label for="titre">Titre</label>
    <input type="titre" id="titre" name="titre" value="<?php echo $produit_actuel['titre'] ?? ''; ?>">

    <label for="description">Description</label>
    <input type="text" id="description" name="description" value="<?php echo $produit_actuel['description'] ?? ''; ?>">

    <label for="photo">Photo</label>
    <input type="file" id="photo" name="photo" >
        <!-- Modification de la photo -->
    <?php
        if (isset($produit_actuel['photo'])){
            echo '<i>Vous pouvez uploader une nouvelle photo</i><br>';
            // Afficher la photo actuelle : 
            echo '<img src="'. $produit_actuel['photo'] .'" width="90" height="90" ><br>' ;
            // Mettre le chemin de la photo dans un champ caché pour l'enregistrer en base : 
            echo '<input type="hidden" name="photo_actuelle" value="'. $produit_actuel['photo'] .'">'; // ce champs renseigne le $_POST['photo_actuelle'] qui va en base quand on soumet le formulaire de modification. Si on ne remplit pas le formulaire ici, le champ photo de la base est remplacé par un vide, ce qui efface le chemin de la photo. 
        }
    ?>

    <label for="pays">Pays</label>
    <input type="text" id="pays" name="pays" value="<?php echo $produit_actuel['pays'] ?? ''; ?>">

    <label for="ville">Ville</label>
    <input type="text" id="ville" name="ville" value="<?php echo $produit_actuel['ville'] ?? ''; ?>">

    <label for="adresse">Adresse</label>
    <input type="text" id="adresse" name="adresse" value="<?php echo $produit_actuel['adresse'] ?? ''; ?>">

    <label for="cp">Code Postal</label>
    <input type="text" id="cp" name="cp" value="<?php echo $produit_actuel['cp'] ?? ''; ?>">

    <label for="capacite">Capacité</label>
    <input type="number" id="capacite" name="capacite" value="<?php echo $produit_actuel['capacite'] ?? ''; ?>">

    <label for="categories">Catégorie</label>
    <select name="categories" id="categories">
        <option value="null">-- Séléctionner --</option>
        <option name="categories" value="reunion" <?php if(isset($produit_actuel['categories']) && $produit_actuel['categories'] == 'reunion') echo 'selected'; ?>>Réunion</option>
        <option name="categories" value="bureau" <?php if(isset($produit_actuel['categories']) && $produit_actuel['categories'] == 'bureau') echo 'selected'; ?>>Bureau</option>
        <option name="categories" value="formation" <?php if(isset($produit_actuel['categories']) && $produit_actuel['categories'] == 'formation') echo 'selected'; ?>>Formation</option>
    </select>

    <input type="submit" value="Enregistrer">
</form>

<?php 




require_once('../inc/bas.inc.php');



