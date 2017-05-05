<?php

/* 1- Créer une base de données "contacts" avec une table "contact" :
	  id_contact PK AI INT(3)
	  nom VARCHAR(20)
	  prenom VARCHAR(20)
	  telephone INT(10)
	  annee_rencontre (YEAR)
	  email VARCHAR(255)
	  type_contact ENUM('ami', 'famille', 'professionnel', 'autre')

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. Le champ année est un menu déroulant de l'année en cours à 100 ans en arrière à rebours, et le type de contact est aussi un menu déroulant.
	
	3- Effectuer les vérifications nécessaires :
	   Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	   L'année de rencontre doit être une année valide
	   Le type de contact doit être conforme à la liste des types de contacts
	   L'email doit être valide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter les contacts à la BDD et afficher un message en cas de succès ou en cas d'échec.

*/



// Traitement du formulaire 

	// Connexion à la base de données
	$pdo = new PDO('mysql:host=localhost;dbname=contacts', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

	$message_erreur = '';

	// Contrôle des champs du formulaire 
	if(!empty($_POST)) {  // Si $_POST n'est pas vide, alors le formulaire a bien été poste
		

		// Champ nom - contient au moins deux caractères
		if(strlen($_POST['nom']) < 2 && strlen($_POST['nom']) > 20){
			$message_erreur .= '<div>Le nom doit contenir au moins 2 caractères</div>';
		}

		// Champ prenom - contient au moins deux caractères
		if(strlen($_POST['prenom']) < 2 && strlen($_POST['prenom']) > 20){
			$message_erreur .= '<div>Le prénom doit contenur au moins 2 caractères </div>';
		}

		// Champ telephone - contient au moins dix chiffres
		if(!preg_match('#^[0-9]{10}$#', $_POST['telephone'])){
			$message_erreur .= '<div>Le numéro de téléphone n\'est pas valide</div>';
		}

		// Champ annee de rencontre - le champ doit être valide
		if(!(is_numeric($_POST['annee_rencontre']) && checkdate('01', '01', $_POST['annee_rencontre']))){
			$message_erreur .= '<div>Veuillez sélectionner une année valide</div>';
		}

		// Champ email - doit être valide
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$message_erreur .= '<div>L\'email n\'est pas valide</div>';
		}
		// Champ type de contact 
		if($_POST['type_contact'] != 'ami' && $_POST['type_contact'] != 'famille' && $_POST['type_contact'] != 'professionnel' && $_POST['type_contact'] != 'autre'){
			$message_erreur .= '<div>Veuillez sélectionner un type de contact. </div>';
		}

		if(empty($message_erreur)){

			// Traitement des failles XSS et CSS
			$_POST['nom'] = htmlspecialchars($_POST['nom'], ENT_QUOTES);
			$_POST['prenom'] = htmlspecialchars($_POST['prenom'], ENT_QUOTES);
			$_POST['telephone'] = htmlspecialchars($_POST['telephone'], ENT_QUOTES);
			$_POST['annee_rencontre'] = htmlspecialchars($_POST['annee_rencontre'], ENT_QUOTES);
			$_POST['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);
			$_POST['type_contact'] = htmlspecialchars($_POST['type_contact'], ENT_QUOTES);

			/* OU ALORS
				foreach($_POST as $indice => $valeur){
				$_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
			} */

			$resultat = $pdo->prepare("INSERT INTO contact (nom, prenom, telephone, annee_rencontre, email, type_contact) VALUES (:nom, :prenom, :telephone, :annee_rencontre, :email, :type_contact)");
			
			$resultat->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
			$resultat->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
			$resultat->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_INT);
			$resultat->bindParam(':annee_rencontre', $_POST['annee_rencontre'], PDO::PARAM_STR);
			$resultat->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
			$resultat->bindParam(':type_contact', $_POST['type_contact'], PDO::PARAM_STR);
			
			$requeteContact = $resultat->execute();

			if($requeteContact) {
				$message_erreur .= '<div>Le contact a bien été ajouté</div>';
			} else {
				$message_erreur .= '<div>Une erreur est survenue durant l\'enregistrement</div>';
			}
		}

	}

echo '<pre>'; print_r($_POST); echo '</pre>';

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Ajouter un contact</title>
	</head>

	<body>
		<h1>Ajouter un contact</h1>

		<?php echo $message_erreur; ?>


		<form method="post" action="">
			<label for="nom">Nom</label> <br>
			<input type="text" id="nom" name="nom" value=""> <br><br>

			<label for="prenom">Prénom</label><br>
			<input type="text" id="prenom" name="prenom" value=""><br><br>
			
			<label for="telephone">Téléphone</label><br>
			<input type="tel" id="telephone" name="telephone" value=""><br><br>
			
			<label for="annee_rencontre">Année de rencontre</label><br>
			<select name="annee_rencontre" id="annee_rencontre">
			<?php 
				// $date_actuelle = date('Y'); 
				// $i = $date_actuelle - 100;  
				// while($date_actuelle >= $i){
				// 	echo "<option>$date_actuelle</option>";
				// 	$date_actuelle--;
				// }
				for($i=date('Y'); $i>=date('Y'))
			?>
			<select><br><br>

			<label for="email">E-mail</label><br>
			<input type="email" id="email" name="email" value=""><br><br>

			<label for="type_contact">Type de contact</label><br>
			<select name="type_contact" id="type_contact">
				<option value="ami">Ami</option>
				<option value="famille">Famille</option>
				<option value="professionnel">Professionnel</option>
				<option value="autre">Autre</option>
			</select><br><br>

			<input type="submit" value="Envoyer">
		</form>
	</body>
</html>