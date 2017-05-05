<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec les champs nom, prénom, téléphone, et un champ supplémentaire "autres infos" avec un lien qui permet d'afficher le détail de chaque contact.

	2- Afficher sous la table HTML le détail d'un contact quand on clique sur le lien "autres infos".



*/

// Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=contacts', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Requête de la base de données
$requete = $pdo->query("SELECT id_contact, nom, prenom, telephone FROM contact"); 


echo '<table border = "1">
	<tr>
		<th>Nom</th>
		<th>Prenom</th>
		<th>Téléphone</th>
		<th>Autres infos</th>
	</tr>';

// $contact = $requete->fetch(PDO::FETCH_ASSOC);
// print_r($contact);

while($ligne = $requete->fetch(PDO::FETCH_ASSOC)){
	echo '<tr>';

	echo '<td>' . $ligne['nom'] . '</td>';
	echo '<td>' . $ligne['prenom'] . '</td>';
	echo '<td>' . $ligne['telephone'] . '</td>';
	echo '<td><a href="?id_contact='. $ligne['id_contact'] .'">Détails</a></td>';
	echo '</tr>';
}

echo '</table>';

$details = ''; 


if(!empty($_GET)){

	$id_contact = $_GET['id_contact'];
	$requeteDetails = $pdo->query("SELECT * FROM contact WHERE id_contact = '$id_contact'");

	$contacts = $requeteDetails->fetch(PDO::FETCH_ASSOC); 

	$details .= 	'<ul>
						<li> Prénom : '. $contacts['nom'] .'</li> 
						<li> Nom : '. $contacts['prenom'] .'</li> 
						<li> Numéro de téléphone : '. $contacts['telephone'] .'</li> 
						<li> Email : '. $contacts['email'] .'</li> 
						<li> Année de rencontre : '. $contacts['annee_rencontre'] .'</li> 
						<li> Type de contact : '. $contacts['type_contact'] .'</li> 	
					</ul>';

} 

echo $details;



?>
