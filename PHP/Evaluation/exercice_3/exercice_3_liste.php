<?php
// DECLARER LES VARIABLES DE CONTENUS 
$contenu = "";

// CONNEXION A LA BDD
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


// Requête dans la base de données pour récupérer les éléments à afficher dans le tableau

$query = $pdo->prepare("SELECT id_movie, title, director, year_of_prod FROM movies");
$query->execute(); 

// Affichage du tableau HTML
$contenu .= '<table border="1">
                <tr>
                    <th>Titre</th>
                    <th>Réalisateur</th>
                    <th>Année de production</th>
                    <th>Autres</th>
                </tr>'; 

// On crée une boucle durant laquelle on transforme les résultats de la requête
while($resultat = $query->fetch(PDO::FETCH_ASSOC)){
    $contenu .= '<tr>
                    <td>'. $resultat['title'] .'</td>
                    <td>'. $resultat['director'] .'</td>
                    <td>'. $resultat['year_of_prod'] .'</td>
                    <td><a href="exercice_3_details.php?id_movie='.$resultat['id_movie'].'">Plus d\'infos</a></td>
                </tr>';
}


$contenu .= '</table>';

?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Liste des films</title>

        <style>
            h1{color: darkslateblue;}
            table, h1{ text-align: center;}
            table, td, th{margin: auto; padding: 10px;}
            th{font-size: 20px; color: darkslateblue;}
        </style>
    </head>
    <body>
        <h1>Liste des films</h1>
        <?php echo $contenu; ?>
    </body>
</html>