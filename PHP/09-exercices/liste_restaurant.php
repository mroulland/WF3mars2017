<?php 

/* 
    1 - Afficher dans une table HTML la liste des restaurants avec les champs nom et téléphone, et un champ supplémentaire "autres infos" avec un lien qui permet d'afficher le détail de chaque contact. 

    2- Afficher sous la table HTML le détail d'un contact quand on clique sur le lien "autres infos".

*/

$tableau = "";
$contenu = "";

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=restaurants', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


// Affichage du tableau de résultat
$listeRestaurant = $pdo->query("SELECT * FROM restaurant");

while($restaurant = $listeRestaurant->fetch(PDO::FETCH_ASSOC)){
    $tableau .= '<tr>';
            $tableau .= '<td>'. $restaurant['nom'] .'</td>';
            $tableau .= '<td>'. $restaurant['telephone'] .'</td>';
            $tableau .= '<td><a href="?id_restaurant='. $restaurant['id_restaurant'] .'"> Autres infos </a></td>';
    $tableau .= '</tr>';
}


// Affichage des détails
if(isset($_GET['id_restaurant'])){

    $query = $pdo->prepare("SELECT * FROM restaurant WHERE id_restaurant = :id_restaurant");
    $query->bindParam(':id_restaurant', $_GET['id_restaurant'], PDO::PARAM_INT);
    $query->execute();

    $details = $query->fetch(PDO::FETCH_ASSOC);

    if($details){
        $contenu .= '<ul>
                        <li> Nom : '. $details['nom'] .'</li> 
                        <li> Adresse : ' . $details['adresse'] . '</li> 
                        <li> Numéro de téléphone : ' . $details['telephone'] . ' </li> 
                        <li> Type : ' . $details['type'] . ' </li> 
                        <li> Note : ' . $details['note'] . ' </li> 
                        <li> Avis : ' . $details['avis'] . ' </li> 
                    </ul>';
    } else {
        $contenu .= "Ce restaurant n'existe pas.";
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Liste des restautants</title>
    </head>

    <body>

        <h1>Liste des restaurants</h1>
        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Autres</th>
            </tr>

            <tr>
                <?php echo $tableau; ?>
            </tr>

        </table>

        <section>
            <?php echo $contenu; ?>
        </section>
    </body>
</html>
