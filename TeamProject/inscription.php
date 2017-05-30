<?php

require_once('inc/init.inc.php');

$inscription = false;

var_dump($_POST);

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

    if($_POST['civilite'] == 'null' || $_POST['civilite'] != 'h' && $_POST['civilite'] !='f') {
        $contenu .= '<div>La civilité est incorrecte</div>';
    }

    if(empty($contenu)) {   // si contenu est vide c'est qu'il n'y pas d'erreur

        // On vérifie que le pseudo n'existe pas 
        $membre = executeRequete("SELECT id_membre FROM membre WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));

        if($membre->rowCount() > 0) {   // s'il y a des lignes dans le résultat de la requête
            $contenu .= '<div>Le pseudo est indisponible : veuillez en choisir un autre</div>';

        } else {
            // Si le pseudo est unique, on peut faire l'inscription en BDD :

            $_POST['mdp'] = md5($_POST['mdp']); // permet d'encrypter le mot de passe selon l'algorithme md5. Il faudra le faire aussi sur la page de connexion pour comparer 2 mots cryptés. 

            executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :civilite, 0, now())", array(':pseudo' => $_POST['pseudo'], ':mdp' => $_POST['mdp'],':nom' => $_POST['nom'], ':prenom' => $_POST['prenom'], ':email' => $_POST['email'],':civilite' => $_POST['civilite']));

            $contenu  .='<div>Vous êtes inscrits. <a href="connexion.php">Cliquez ici pour vous connecter</a></div>';
            $inscription = true; 

        }

     }  // fin du if(empty($contenu))

} // fin du if(!empty($_POST))


require_once('inc/haut.inc.php');
echo $contenu;  // affiche les messages du site

if (!$inscription) : // si personne non-inscrite, le formulaire s'affiche

?>
     
        <form method="post"action="">
            
            <label for="pseudo">Pseudo</label><br>
            <input type="text" name="pseudo" id="pseudo"><br><br>

            <label for="mdp">Mot de passe</label><br>
            <input type="password" name="mdp" id="mdp"><br><br>

            <label for="nom">Nom</label><br>
            <input type="text" name="nom" id="nom"><br><br>

            <label for="prenom">Prenom</label><br>
            <input type="text" name="prenom" id="prenom"><br><br>

            <label for="email">Email</label><br>
            <input type="email" name="email" id="email"><br><br>

            <label for="civilite">Civilité</label><br>
            <select name="civilite" id="civilite">
                <option value="null"> -Sélectionner- </option>
                <option value="h">Homme</option>
                <option value="f">Femme</option>
            </select><br><br>

            <input type="submit" value="Inscription">
        
        </form>
        
<?php 
endif;

require_once('inc/bas.inc.php');