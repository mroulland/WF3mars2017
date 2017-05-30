<?php

require_once('../inc/init.inc.php');


$content = '';
$contenu ='';

if(!connectedAdmin()) {
    header('location:../connexion.php'); // si membre pas admin, alors on le redirigie vers la page de connexion qui est à la racine du site (en dehors du dossier admin)
    exit();
}


// ------------------- SUPPRESSION D'UN MEMBRE ----------------------------

        if (isset($_GET['action']) && $_GET['action'] == 'vider' && isset($_GET['id_membre'])) {

            $resultat = executeRequete("DELETE FROM membre WHERE id_membre = :id_membre", array(':id_membre'=> $_GET ['id_membre']));
 

}

if(!empty($_POST)) { // si le formulaire est posté

    // validation du formulaire :

    if(strlen($_POST['pseudo']) < 2 || strlen($_POST['pseudo'])> 20) {
        $contenu .='<div>Le pseudo doit contenir au moins 2 caractères </div>';
    }

    if(strlen($_POST['mdp']) < 4 || strlen($_POST['mdp'])> 20) {
        $contenu .='<div>Le mot de passe doit contenir au moins 4 caractères </div>';
    }

    if(strlen($_POST['nom']) < 2 || strlen($_POST['nom'])> 20) {
        $contenu .='<div>Le nom doit contenir au moins 2 caractères </div>';
    }

    if(strlen($_POST['prenom']) < 2 || strlen($_POST['prenom'])> 20) {
        $contenu .='<div>Le prénom doit contenir au moins 2 caractères </div>';
    }

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $contenu .= '<div>L\'email est invalide</div>';
    }

    if($_POST['civilite'] != 'h' && $_POST['civilite'] !='f') {
        $contenu .= '<div>La civilité est incorrecte</div>';
    }

     if($_POST['statut'] != '0' && $_POST['statut'] !='1') {
        $contenu .= '<div>Le statut est incorrect</div>';
    }

     if(empty($contenu)) {   // si contenu est vide c'est qu'il n'y pas d'erreur

        // On vérifie que le pseudo n'existe pas 
        $membre = executeRequete("SELECT id_membre FROM membre WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));

        if($membre->rowCount() > 0) {   // s'il y a des lignes dans le résultat de la requête
            $contenu .= '<div>Le pseudo est indisponible : veuillez en choisir un autre</div>';

        } else {
            // Si le pseudo est unique, on peut faire l'inscription en BDD :

            $_POST['mdp'] = md5($_POST['mdp']); // permet d'encrypter le mot de passe selon l'algorithme md5. Il faudra le faire aussi sur la page de connexion pour comparer 2 mots cryptés. 

            executeRequete("REPLACE INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :civilite, 0, now())", array(':pseudo' => $_POST['pseudo'], ':mdp' => $_POST['mdp'],':nom' => $_POST['nom'], ':prenom' => $_POST['prenom'], ':email' => $_POST['email'],':civilite' => $_POST['civilite']));

            $contenu  .='<div>Le membre a bien été enregistré</div>';
           

        }

     }  // fin du if(empty($contenu))

} // Fin de la vérification du formulaire






// ---------------------------------------- AFFICHAGE DE LA LISTE DES MEMBRES ----------------------------------------


// Table html

$resultat = executeRequete('SELECT * FROM membre');
$content .= '<h3>Liste des membres</h3>
			 <table border=".2rem solid grey">';
		$content .= '<tr>
                        <th>Id_membre</th>
						<th>Pseudo</th>
						<th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Civilité</th>
                        <th>Statut</th>
                        <th>Date d\'enregistrement</th>
						<th>Actions</th>
					</tr>';

if(isset($_POST)){

    while ($membres = $resultat->fetch(PDO::FETCH_ASSOC)){
		$content .= '<tr>
						<td>'. $membres['id_membre'] .'</td>
						<td>'. $membres['pseudo'] .'</td>
						<td>'. $membres['nom'] .'</td>
						<td>'. $membres['prenom'] .'</td>
						<td>'. $membres['email'] .'</td>
						<td>'. $membres['civilite'] .'</td>
						<td>'. $membres['statut'] .'</td>
						<td>'. $membres['date_enregistrement'] .'</td>
						
						<td>
							<a href="?id_membre='. $membres['id_membre'] .'"><i class="fa fa-search" aria-hidden="true"></i></a>
                            <a href="?action=modifier&id_membre='. $membres['id_membre'] .'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="?action=vider&id_membre='. $membres['id_membre'] .'"><i class="fa fa-trash" aria-hidden="true"></i></a>
						</td>
					</tr>';
	}			
			
$content .= '</table>';

} else{ // Affichage un tableau vide


         $content .= '<tr>
						<td> -- </td>
										
				</tr>';
	
    

$content .= '</table>';		

}






require_once('../inc/haut.inc.php');




// ------------------- MODIFICATION D'UN MEMBRE ----------------------------

//  Si modification d'un membre, on affiche le formulaire

        if (isset($_GET['action']) && $_GET['action'] =='modifier' && isset($_GET['id_membre'])) {
            // Pour préremplir le formulaire, on requête en BDD les infos du membre passé dans l'URL :
            $resultat = executeRequete("SELECT * FROM membre WHERE id_membre = :id_membre", array(':id_membre'=> $_GET ['id_membre']));

            $membre_actuel = $resultat->fetch(PDO::FETCH_ASSOC); 

}


    ?>


<!-- Formulaire de modification -->

<h2>Gestion des membres</h2>

        <form method="post"action="">

        <?php 
        echo $contenu;
        echo $content; 
       
        ?>
            <article>

                <label for="pseudo">Pseudo</label><br>
                <i class="fa fa-user" aria-hidden="true"></i><input type="text" name="pseudo" id="pseudo" value="<?php echo $membre_actuel['pseudo'] ?? ""; ?>"><br><br>

                <label for="mdp">Mot de passe</label><br>
                <i class="fa fa-lock" aria-hidden="true"></i><input type="password" name="mdp" id="mdp" value="<?php echo $membre_actuel['mdp'] ?? ""; ?>"><br><br>

                <label for="nom">Nom</label><br>
                <i class="fa fa-pencil" aria-hidden="true"></i><input type="text" name="nom" id="nom" value="<?php echo $membre_actuel['nom'] ?? ""; ?>"><br><br>

                <label for="prenom">Prenom</label><br>
                <i class="fa fa-pencil" aria-hidden="true"></i><input type="text" name="prenom" id="prenom" value="<?php echo $membre_actuel['prenom'] ?? ""; ?>"><br><br>

            </article>
            
            <article>

                <label for="email">Email</label><br>
                <i class="fa fa-envelope" aria-hidden="true"></i><input type="email" name="email" id="email" value="<?php echo $membre_actuel['email'] ?? ""; ?>"><br><br>

                <label for="civilite">Civilité</label><br>
                <select name="civilite" id="civilite">
                    <option value="h" <?php if(isset($membre_actuel['civilite']) && $membre_actuel['civilite'] == 'h') echo 'selected'; ?>>Homme</option>
                    <option value="f" <?php if(isset($membre_actuel['civilite']) && $membre_actuel['civilite'] == 'f') echo 'selected'; ?>>Femme</option>
                </select><br><br>

                <label for="statut">Statut</label><br>
                <select name="statut" id="statut">            
                    <option value="0" <?php if(isset($membre_actuel['statut']) && $membre_actuel['statut'] == '0') echo 'selected'; ?>>Admin</option>
                    <option value="1" <?php if(isset($membre_actuel['statut']) && $membre_actuel['statut'] == '1') echo 'selected'; ?>>Membre</option>
                </select><br><br>

        
                <input type="submit" value="Enregistrer">

            </article>
           
        
        </form>




<?php



require_once('../inc/bas.inc.php');
