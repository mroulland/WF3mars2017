<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Location de salles</title>

    <link rel="stylesheet" href="<?php echo RACINE_SITE . 'inc/css/style.css'; ?>">
    
</head>

    <body>
   
        <nav>   
            <ul id="menu-deroulant">
                <li><a href="<?php echo RACINE_SITE . 'page_accueil.php';?>">Salle A</a></li>
                <li><a href="<?php echo RACINE_SITE . 'page_accueil.php'; ?>">Accueil</a></li>
                <li><a href="<?php echo RACINE_SITE . 'connexion.php';?> ">Espace membre</a></li>
                <li><a href="<?php echo RACINE_SITE . 'profil.php';?>">Profil</a></li>
                <li><a href="<?php echo RACINE_SITE . 'about.html';?>">Qui sommes nous</a></li>
                <li><a href="<?php echo RACINE_SITE . 'contact.html';?>">Contact</a></li>
                <?php if(connectedAdmin()) {
                    echo '<li><a href="#">Administration</a></li>
                    <ul>';
                    
                            echo '<li><a href=" '. RACINE_SITE .'admin/gestion_salles.php">Gestion des salles</a></li>';

                            echo '<li><a href=" '. RACINE_SITE .'admin/gestion_produits.php">Gestion des produits</a></li>';

                            echo '<li><a href=" '. RACINE_SITE .'admin/gestion_membres.php">Gestion des membres</a></li>';     
                        }
                    ?>
                    </ul>
                </li>
            </ul>
        </nav>

        <main>
            <h1>Salles A <span>Location de salles pour vos events professionnels</span></h1>

    
    
