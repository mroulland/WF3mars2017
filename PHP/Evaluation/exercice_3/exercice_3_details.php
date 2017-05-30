<?php

// Connexion à la BDD
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


// Afficher les détails des films
$contenu = "";

// var_dump($_GET);

if(isset($_GET['id_movie'])){

    // On séléctionne toutes les informations de la BDD par film demandé
    $query = $pdo->prepare("SELECT * FROM movies WHERE id_movie = :id_movie");
    $query->bindParam(':id_movie', $_GET['id_movie'], PDO::PARAM_INT);
    $query->execute();

    // On transforme les résultats en array associatif
    $details = $query->fetch(PDO::FETCH_ASSOC);

    if(!empty($details)){
        $contenu .= '<h2>'. $details['title'] .'</h2>';
        $contenu .= '<p><b>Titre du film :</b> '. $details['title'] .'</p>';
        $contenu .= '<p><b>Réalisateur : </b>'. $details['director'] .'</p>';
        $contenu .= '<p><b>Acteurs :</b> '. $details['actors'] .'</p>';
        $contenu .= '<p><b>Producteur : </b>'. $details['producer'] .'</p>';
        $contenu .= '<p><b>Année de production :</b> '. $details['year_of_prod'] .'</p>';
        $contenu .= '<p><b>Langue :</b> '. $details['language'] .'</p>';
        $contenu .= '<p><b>Catégorie : </b>'. $details['category'] .'</p>';
        $contenu .= '<p><b>Résumé du film : </b>'. $details['storyline'] .'</p>';
        $contenu .= '<p><b>Bande-annonce :</b> <a href="'. $details['video'] .'">Youtube</a></p>';

    } else {
        $contenu .= "<div>Ce film n'existe pas.</div>";
    }
} 

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Détails du film</title>

        <style>
            h2{color: darkslateblue; text-align: center; }
            section{border: 1px solid darkslateblue; width: 40%; margin:auto; padding: 10px; border-radius: 15px; background-color: rgba(72, 61, 139, 0.2);}
        </style>
    </head>
    <body>
        <section>
            <?php echo $contenu; ?>
        </section>
    </body>
</html>
