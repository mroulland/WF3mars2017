<?php
/*
   1- Vous créez un formulaire avec un menu déroulant avec les catégories A,B,C et D de véhicules de location et un champ nombre de jours de location. Lorsque le formulaire est soumis, vous affichez "La location de votre véhicule sera de X euros pour Y jour(s)." sous le formulaire.

   2- Vous validez le formulaire : la catégorie doit être correcte et le nombre de jours un entier positif.

   3- Vous créez une fonction prixLoc qui retourne le prix total de la location en fonction du prix de la catégorie choisie (A : 30€, B : 50€, C : 70€, D : 90€) multiplié par le nombre de jours de location. 

   4- Si le prix de la location est supérieur à 150€, vous consentez une remise de 10%.

*/

// Déclarer les variables de contenu 

$message_erreur = "";
$contenu = "";
$prixTotal = "";

$tabCategorie = array('A' => 30, 'B' => 50, 'C' => 70, 'D' => 90);

// echo '<pre>'; print_r($tabCategorie); echo '</pre>';
// echo '<pre>'; print_r($_POST); echo '</pre>';



// CREATION DE LA FONCTION prixLoc


function prixLoc($categorie, $jours){

    // Déterminer la catégorie choisie par l'utilisateur et lui affecter un prix
    switch ($categorie){
        case 'A' : $prix = 30; break;
        case 'B' : $prix = 50; break;
        case 'C' : $prix = 70; break;
        case 'D' : $prix = 90; break;
        default : $message_erreur .= "Il y a une erreur dans le calcul de la location ... ";
    }

    // Calcul du prix total de la location
    $prixTotal = $prix * $jours;

    // Si le prix total est supérieur à 150, accorder une réduction de 10%
    if($prixTotal >= 150){
        $prixTotal = $prixTotal - (($prixTotal/100)*10);
    }

    // Retourner une phrase indiquant le tarif à l'utilisateur
    return "<div>Vous avez choisi un véhicule de catégorie " . $categorie . ". Votre location vous coûtera " . $prixTotal . " € pour " . $jours . " jours.</div>"; 
}
 

//  TRAITEMENT DU FORMULAIRE 

if(!empty($_POST)){
    if(!array_key_exists($_POST['categorie'], $tabCategorie)){
        $message_erreur .= "<div>La catégorie sélectionnée n'est pas valide</div>";
    }

    if(!is_numeric( $_POST['nombre_jour'])){
        $message_erreur .= "<div>Le nombre de jour n'est pas correct</div>";
    }

    if(empty($message_erreur)){
        $contenu .= prixLoc($_POST['categorie'], $_POST['nombre_jour']);
    }

}


?>
<style>

    *{
        box-sizing: border-box;
    }
    body{
        margin: auto;
        max-width: 500px;
        text-align : center;
    }

    h1{
        color: #285858;
        font-size: 40px;
        text-shadow: 0 0.2px 0.2px black;
        text-align: center;
    }

    table{
        border: 1px solid #758c8c;
        color: #285858;
        margin: auto;
        text-align: center;
        padding: 5px;
        width: 50%;
        background-color: #83d6d6;
        border-radius: 10px;
    }

    tr{
        border: 1.5px solid #758c8c;
        padding : 5px;
    }
    
    p{
        color: #285858;
        font-size: 20px;

    }

    form{
        border: 1px solid #758c8c;
        width: 50%;
        padding: 10px;
        margin: auto;
        text-align: center;
        background-color: #83d6d6;
        border-radius: 10px;
    }

    input, select{
        background-color: #3f8888;
        border: none;
        padding: 5px;
        margin: 5px;
    }

    label{
        color: #285858;
        font-size: 15px;
        margin: 5px;
    }

    div{
        margin: 10px auto;
        text-align: center;
        font-weight: bold;
        color: darkred;
    }



</style>


<!-- AFFICHAGE -->


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Location de voiture</title>
    </head>
    <body>

    <h1>Louer votre voiture</h1>

    <table>
        <tr>
            <th>Catégories</th>
            <th>Prix</th>
        </tr>
        <?php 
            foreach($tabCategorie as $indice => $valeur){
                echo '<tr>';
                    echo '<td>'. $indice .'</td> <td> '. $valeur .'</td>';
                echo '</tr>';
            }
        ?>
    </table>

    <p>Profitez de 10% de réduction dès 150€ ! </p>
    <?php echo $message_erreur ?>

    <form method="post"action="">
        <label for="categorie">Les catégories : </label><br>
        <select name="categorie" id="categorie">
            <?php 
                foreach($tabCategorie as $indice => $valeur){
                    echo '<option value="' . $indice . '">'. $indice .'</option>';
                }
            ?>
        </select><br><br>
        <label for="nombre_jour">Nombre de jours : </label><br>
        <input type="number" id="nombre_jour" name="nombre_jour" value=""><br><br>

        <input type="submit"><br>

    </form>

    <?php echo  $contenu; ?>


        
    </body>
</html>