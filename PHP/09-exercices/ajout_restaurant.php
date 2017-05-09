<?php

/* 1- Créer une base de données "restaurants" avec une table "restaurant" :
	  id_restaurant PK AI INT(3)
	  nom VARCHAR(100)
	  adresse VARCHAR(255)
	  telephone VARCHAR(10)
	  type ENUM('gastronomique', 'brasserie', 'pizzeria', 'autre')
	  note INT(1)
	  avis TEXT

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un restaurant dans la bdd. Les champs type et note sont des menus déroulants que vous créez avec des boucles.
	
	3- Effectuer les vérifications nécessaires :
	   Le champ nom contient 2 caractères minimum
	   Le champ adresse ne doit pas être vide
	   Le téléphone doit contenir 10 chiffres
	   Le type doit être conforme à la liste des types de la bdd
	   La note est un nombre entre 0 et 5
	   L'avis ne doit être vide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter le restaurant à la BDD et afficher un message en cas de succès ou en cas d'échec.

*/

// Déclarer les variables de contenus 

$message = "";
$contenu = "";
$type = array('gastronomique', 'brasserie', 'pizzeria', 'autre');

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=restaurants', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


// Validation du formulaire 

	if(!empty($_POST)){

		echo '<pre>'; print_r($_POST); echo '</pre>';

		//    Le champ nom contient 2 caractères minimum
		if(strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 100){
			$message .= "<div>Le nom doit contenir plus de 2 caractères.</div>";
		}
		//    Le champ adresse ne doit pas être vide
		if(empty($_POST['adresse'])){
			$message .= "<div>L'adresse doit être remplie.</div>";
		}

		//    Le téléphone doit contenir 10 chiffres
		if(!preg_match('#^[0-9]{10}$#', $_POST['telephone'])){
			$message .= "<div>Le numéro de téléphone n'est pas valide.</div>";
		}

		//    Le type doit être conforme à la liste des types de la bdd
		if(!in_array($_POST['type'], $type)){
			$message .= "<div>Le type de restaurant n'est pas valide.</div>";
		}

		//    La note est un nombre entre 0 et 5
		if(!is_numeric($_POST['note']) || $_POST['note'] < 0 || $_POST['note'] > 5){
			$message .= "<div>La note entrée n'est pas valide.</div>";
		}

		//    L'avis ne doit être vide
		if(empty($_POST['avis'])){
			$message .= "<div>Vous devez remplir l'avis.</div>";
		}

		//    Si aucun message d'erreur n'existe, on ajoute le restaurant à la BDD
		if(empty($message)){
			
			// Traitement des failles XSS et CSS 
			$_POST['nom'] = htmlspecialchars($_POST['nom'], ENT_QUOTES);
			$_POST['adresse'] = htmlspecialchars($_POST['adresse'], ENT_QUOTES);
			$_POST['telephone'] = htmlspecialchars($_POST['telephone'], ENT_QUOTES);
			$_POST['type'] = htmlspecialchars($_POST['type'], ENT_QUOTES);
			$_POST['note'] = htmlspecialchars($_POST['note'], ENT_QUOTES);
			$_POST['avis'] = htmlspecialchars($_POST['avis'], ENT_QUOTES);

			// Requête SQL
			$requete = $pdo->prepare("INSERT INTO restaurant (nom, adresse, telephone, type, note, avis) VALUES(:nom, :adresse, :telephone, :type, :note, :avis)");

			// Associer les marqueurs aux valeurs $_POST
			$requete->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
			$requete->bindParam(':adresse', $_POST['adresse'], PDO::PARAM_STR);
			$requete->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_STR);
			$requete->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
			$requete->bindParam(':note', $_POST['note'], PDO::PARAM_INT);
			$requete->bindParam(':avis', $_POST['avis'], PDO::PARAM_STR);

			// Exécuter la requête
			$resultat = $requete->execute();

			if($resultat){
				$message .= "<div>Le restaurant a bien été ajouté !</div>";
			} else{
				$message .= "<div>Il y a eu une erreur lors de l'ajout.</div>";
			}
		}


	} // Fin du !empty($_POST)

	$listeRestaurant = $pdo->query("SELECT * FROM restaurant");



	while($restaurant = $listeRestaurant->fetch(PDO::FETCH_ASSOC)){
		$contenu .= '<tr>';
		$contenu .= '<td>'. $restaurant['nom'] .'</td>';
		$contenu .= '<td>'. $restaurant['adresse'] .'</td>';
		$contenu .= '<td>'. $restaurant['telephone'] .'</td>';
		$contenu .= '<td>'. $restaurant['type'] .'</td>';
		$contenu .= '<td>'. $restaurant['note'] .'</td>';
		$contenu .= '<td>'. $restaurant['avis'] .'</td>';
		$contenu .= '</tr>';

	}

?>


<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Restaurant</title>
	</head>
	<body>

		<h1>Ajouter un restaurant</h1>

		<?php echo $message; ?>

		<form method="post" action="">

			<label for="nom">Nom : </label><br>
			<input type="text" id="nom" name="nom" value=""><br><br>

			<label for="adresse">Adresse : </label><br>
			<input type="text" id="adresse" name="adresse" value=""><br><br>
			
			<label for="telephone">Télephone : </label><br>
			<input type="text" id="telephone" name="telephone" value=""><br><br>

			<label for="type">Type : </label>
			<select name="type" id="type">
				<option value="null">-- Séléctionner --</option>
				<?php 
					foreach($type as $indice => $valeur){
						echo "<option value=$valeur> $valeur</option>";
					}
				?>
			</select><br><br>

			<label for="note">Note :</label>
			<select name="note" id="note">
				<?php
					for($i=0; $i<=5; $i++){
						echo "<option value=$i>$i</option>";
					}
				?>
			</select><br><br>

			<label for="avis">Avis</label> <br>
			<textarea name="avis" id="avis"></textarea><br><br>

			<input type="submit">

		</form>

		<section>
		<h2>Liste des restaurants</h2>
			<table border = "1">
				<?php echo $contenu; ?>
			</table>
		</section>
		
	</body>
</html>
