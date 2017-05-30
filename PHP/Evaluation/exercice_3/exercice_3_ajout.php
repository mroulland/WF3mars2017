<?php

// DECLARATION DES DIFFERENTES VARIABLES DE CONTENUS 
$message = "";

$language = array('Français', 'Anglais', 'Italien', 'Espagnol', 'Japonais', 'Chinois', 'autre');
$category = array('comedy', 'action', 'thriller', 'romance', 'autre');

// Connexion à la base de données :
$pdo = new PDO('mysql:host=localhost;dbname=exercice_3', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// TRAITEMENT DU FORMULAIRE

if($_POST){
    
    // echo '<pre>'; print_r($_POST); echo '</pre>';

    // Le champ titre contient au moins 5 caractères
    if(strlen($_POST['title']) < 5 || strlen($_POST['title']) > 100){
        $message .= '<div class="error">Le titre doit contenir au moins 5 caractères</div>';
    }
    // Le champ réalisateur contient au moins 5 caractères
    if(strlen($_POST['director']) < 5 || strlen($_POST['director']) > 100){
        $message .= '<div class="error">Le nom du réalisateur doit contenir au moins 5 caractères</div>';
    }
    // Le champ acteurs contient au moins 5 caractères
    if(strlen($_POST['actors']) < 5 || strlen($_POST['actors']) > 100){
        $message .= '<div class="error">Le nom des acteurs doit contenir au moins 5 caractères</div>';
    }
    // Le champ producteur contient au moins 5 caractères
    if(strlen($_POST['producer']) < 5 || strlen($_POST['producer']) > 100){
        $message .= '<div class="error">Le nom du producteur doit contenir au moins 5 caractères</div>';
    }
    // Le champ synopsis contient au moins 5 caractères
    if(strlen($_POST['storyline']) < 5){
        $message .= '<div class="error">Le résumé du film doit contenir au moins 5 caractères</div>';
    }
    // Le champ année de production doit être valide
   if(!(is_numeric($_POST['year_of_prod']) && checkdate('01', '01', $_POST['year_of_prod']))){
       $message .= '<div class="error">L\'année n\'est pas valide.</div>';
   }
    // Le champ langue doit appartenir aux choix de la BDD
    if(!(in_array($_POST['language'], $language))){
        $message .= '<div class="error">La langue n\'est pas valide.</div>';
    }
    // Le champ catégorie doit appartenir aux choix de la BDD
    if(!(in_array($_POST['category'], $category))){
        $message .= '<div class="error">La catégorie n\'est pas valide.</div>';
    }
    
    // Le champ bande-annonce doit contenir une adresse URL valide
    if(!filter_var($_POST['video'], FILTER_VALIDATE_URL)){
        $message .= '<div class="error">L\'url indiquée n\'est pas valide. </div>';
    }

    // Si aucun message d'erreur ne s'affiche, on ajoute le film dans la BDD
    if(empty($message)){

        // Traitement des failles XSS et CSS
        foreach($_POST as $indice => $valeur){
            $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
        }

        // On prépare la requête d'envoi à la BDD
        $requete = $pdo->prepare("INSERT INTO movies (title, actors, director, producer, year_of_prod, language, category, storyline, video) VALUES(:title, :actors, :director, :producer, :year_of_prod, :language, :category, :storyline, :video)");

        // Associer les marqueurs aux valeurs de $_POST
        $requete->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
        $requete->bindParam(':actors', $_POST['actors'], PDO::PARAM_STR);
        $requete->bindParam(':director', $_POST['director'], PDO::PARAM_STR);
        $requete->bindParam(':producer', $_POST['producer'], PDO::PARAM_STR);
        $requete->bindParam(':year_of_prod', $_POST['year_of_prod'], PDO::PARAM_INT);
        $requete->bindParam(':language', $_POST['language'], PDO::PARAM_STR);
        $requete->bindParam(':category', $_POST['category'], PDO::PARAM_STR);
        $requete->bindParam(':storyline', $_POST['storyline'], PDO::PARAM_STR);
        $requete->bindParam(':video', $_POST['video'], PDO::PARAM_STR);

        $resultat = $requete->execute();

        if($resultat){
            $message .= '<div class="success">Le film a bien été ajouté</div>';
        } else {
            $message .= '<div class="error">Il y a eu une erreur lors de l\'ajout du film ...</div>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Exercice 3</title>

        <!-- Eléments de style de la page -->
        <style>
            .error{color: red; text-align:center;}
            .success{color: blue; font-weight: bold; text-align:center;}

            input, label, textarea, select{display: block; margin: 0px auto 10px; text-align: center;}
            h1, h2, a, p{color: darkslateblue; text-align: center;}
            a{text-decoration: none; font-size: 25px;}

            label{font-weight: bold;}
            form{border: 1px solid darkslateblue; width: 40%; margin:auto; padding: 10px; border-radius: 15px; background-color: rgba(72, 61, 139, 0.2);}
        </style>

    </head>

    <body>
        <h1>Et si on regardait un film ?</h1>

        <h2>Ajouter un film :</h2>

        <!-- Afficher les messages d'erreur -->
        <?php echo $message; ?>

        <!-- Formulaire d'ajout du film -->
        <form method="post" action="">

            <label for="title">Titre :</label>
            <input type="text" id="title" name="title">

            <label for="actors">Acteurs :</label>
            <input type="text" id="actors" name="actors">

            <label for="director">Réalisateur :</label>
            <input type="text" id="director" name="director">

            <label for="producer">Producteur :</label>
            <input type="text" id="producer" name="producer">

            <label for="year_of_prod">Année de production :</label>
            <select name="year_of_prod" id="year_of_prod">
                <!-- On ajoute dynamiquement l'année de production -->
                <?php 
                    for($i=date('Y'); $i>=date('Y')-100; $i--){
                        echo "<option value=$i>$i</option>";
                    } 
                ?>
            </select>

            <label for="language">Langue :</label>
            <select name="language" id="language">
                <option value="null">-- Sélectionnez --</option>
                <?php
                    foreach($language as $key => $value){
                        echo "<option value=$value>$value</option>";
                    }
                ?>
            </select>

            <label for="category">Catégorie :</label>
            <select name="category" id="category">
                <option value="null">-- Sélectionnez --</option>
                <?php
                    foreach($category as $key => $value){
                        echo "<option value=$value>$value</option>";
                    }
                ?>
            </select>

            <label for="storyline">Résumé du film :</label>
            <textarea name="storyline" id="storyline"></textarea>

            <label for="video">Bande-annonce :</label>
            <input type="text" id="video" name="video" placeholder="http:// ...">

            <input type="submit" value="Envoyer"> 

        </form>

        <p><a href="exercice_3_liste.php">Voir la liste des films</a></p>

    </body>
</html>