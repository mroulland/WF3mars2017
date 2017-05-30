<?php
/* 
	1- Vous réalisez un formulaire "Votre devis de travaux" qui permet de saisir le montant des travaux de votre maison en HT et de choisir la date de construction de votre maison (bouton radio) : "plus de 5 ans" ou "5 ans ou moins". Ce formulaire permettra de calculer le montant TTC de vos travaux selon la période de construction de votre maison.

	2- Vous réalisez la validation du formulaire : le montant doit être en nombre positif non nul, et la période de construction conforme aux valeurs que vous aurez choisies.

	3- Vous créez une fonction montantTTC qui calcule le montant TTC à partir du montant HT donné par l'internaute et selon la période de construction : le taux de TVA est de 10% pour plus de 5 ans, et de 20% pour 5 ans ou moins. La fonction retourne le résultat du calcul.
	
	Formule de calcul d'un montant TTC :  montant TTC = montant HT * (1 + taux / 100) où taux est par exemple égale à 20.

	4- Vous affichez le résultat calculé par la fonction au-dessus du formulaire : "Le montant de vos travaux est de X euros avec une TVA à Y% incluse."

	5- Vous diffusez des codes de remises promotionnelles, dont un est 'abc' offrant 10% de remise. Ajoutez un champ au formulaire pour saisir le code de remise. Vous validez ce champ qui ne doit pas excéder 5 caractères. Puis la fonction montantTTC applique la remise (-10%) au montant total des travaux si le code de l'internaute est correcte. Vous affichez dans ce cas "Le montant de vos travaux est de X euros avec une TVA à Y% incluse, et y compris une remise de 10%.". 

*/

// DECLARATION DES VARIABLES DE CONTENU
$contenu = "";
$message = "";

// Fonction montantTTC

function montantTTC($montant, $anciennete){

	switch($anciennete){
		case 'younger' : $tva = 20; break;
		case 'older' : $tva = 10; break;
	}

	$montantTTC = $montant * (1 + $tva/100);
	$textRemise = "";

	if($_POST['reduc'] == 'abc'){

		$montantTTC = $montantTTC * (1- 10/100);
		$textRemise =", et y compris une remise de 10%";

	} 

	return "Le montant de vos travaux est de $montantTTC € avec une TVA de $tva% incluse $textRemise.";

	
}


// TRAITEMENT DU FORMULAIRE

var_dump($_POST);

if($_POST){
	if(!is_numeric($_POST['montant']) && $_POST['montant'] <= 0){
		$message .= "Le montant saisi n'est pas valide";
	}

	if(empty($_POST['anciennete']) || $_POST['anciennete'] != 'younger' && $_POST['anciennete'] != 'older' ){
		$message .= "L'ancienneté n'est pas cochée";
	}

	if(strlen($_POST['reduc']) > 5){
		$message .= "Le code réduction n'est pas valide";
	}

	if(empty($message)){

		// Fonction montantTTC
		$contenu .= montantTTC($_POST['montant'], $_POST['anciennete']);

	}
}




//  AFFICHAGE
?>


<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Devis travaux</title>
	</head>
	<body>

		<h1>Votre devis de travaux</h1>

		<?php echo $message; ?>

		<form method= "post" action="">

			<div>
				<label for="montant">Montant HT</label>
				<input type="text" id="montant" name="montant">
			</div>
			<div>
				<label for="anciennete">Quelle est l'ancienneté de votre maison ?</label>
				<p><input type="radio" name="anciennete" id="anciennete" value="younger" > Moins de 5 ans ?</p>
				<p><input type="radio" name="anciennete" id="anciennete" value="older"> Plus de 5 ans ?</p>
			</div>

			<div>
				<label for="reduc">Code promo</label>
				<input type="text" id="reduc" name="reduc">
			</div>

			<input type="submit" value="Envoyer">
		</form>

		<?php echo $contenu; ?>



	</body>
</html>