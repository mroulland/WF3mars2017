<?php

require_once('inc/init.inc.php');



if(!empty($_POST)) { // si le formulaire est posté

    // validation du formulaire :

    if(strlen($_POST['pseudo']) < 2 || strlen($_POST['pseudo'])> 20) {
        $contenu .='<div>Le pseudo doit contenir au moins 2 caractères </div>';
    }

    if(strlen($_POST['commentaire']) < 4 || strlen($_POST['commentaire'])> 255) {
        $contenu .='<div>Veuillez remplir le champ "Commentaire"</div>';
    }

    if (empty($_POST['note'])){
		$contenu .= '<div>La note ne doit pas être vide</div>';
	}


    if (empty($contenu)) {

            $avis = executeRequete("SELECT id_avis FROM avis WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));

            executeRequete('INSERT INTO avis (id_avis, id_membre, id_salle, commentaire, note, date_enregistrement) VALUES(:id_avis, :id_membre, :id_salle, :commentaire, :note, :date_enregistrement)');


            // $query->bindParam(':id_avis', $_POST['id_avis'], PDO::PARAM_STR);
            // $query->bindParam(':id_membre', $_POST['id_membre'], PDO::PARAM_STR);
            // $query->bindParam(':id_salle', $_POST['id_salle'], PDO::PARAM_STR);
            // $query->bindParam(':commentaire', $_POST['commentaire'], PDO::PARAM_STR);
            // $query->bindParam(':note', $_POST['note'], PDO::PARAM_INT);
            // $query->bindParam(':date_enregistrement', $_POST['date_enregistrement'], PDO::PARAM_STR);

            // $succes = $query->execute();

            if ($succes) {
                $contenu .= '<div>Votre avis a bien été pris en compte<div>';
            } else {
                $contenu .= '<div>Erreur lors de l\'enregistrement<div>';
            }

	}	// Fin du if (empty($contenu))


}   // Fin de la vérification des champs


require_once('inc/haut.inc.php');

?>


<h3>Avis</h3>

<form method="post" action="">

    <label for="pseudo">Pseudo</label><br>
    <input type="text" name="pseudo" id="pseudo"><br><br>

    <label for="salle">Salle</label><br>
    <input type="text" name="salle" id="salle"><br><br>

    <label for="commentaire">Commentaire</label><br>
    <textarea name="commentaire" id="commentaire"></textarea><br><br>

    <label for="note">Note</label><br>
        <span title="Donner 1 étoile"><i class="fa fa-star" aria-hidden="true"></i></span>
        <span title="Donner 2 étoiles"><i class="fa fa-star" aria-hidden="true"></i></span>
        <span title="Donner 3 étoiles"><i class="fa fa-star" aria-hidden="true"></i></span>
        <span title="Donner 4 étoiles"><i class="fa fa-star" aria-hidden="true"></i></span>
        <span title="Donner 5 étoiles"><i class="fa fa-star" aria-hidden="true"></i></span>
    

</form>

<?php 


require_once('inc/bas.inc.php');







