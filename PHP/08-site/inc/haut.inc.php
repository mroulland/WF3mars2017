<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ma Boutique</title>
        <!-- Les liens Bootstrap -->
        <link rel="stylesheet" href="<?php echo RACINE_SITE . 'inc/css/bootstrap.min.css'; ?>">
        <link rel="stylesheet" href="<?php echo RACINE_SITE . 'inc/css/shop-homepage.css'; ?>">
        <link rel="stylesheet" href="<?php echo RACINE_SITE . 'inc/css/portfolio-item.css'; ?>">
        <script src="<?php echo RACINE_SITE . 'inc/js/jquery.js'; ?>"></script>
        <script src="<?php echo RACINE_SITE . 'inc/js/bootstrap.min.js'; ?>"></script>
    </head>
    <body>
        <!--  Nav -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?php echo RACINE_SITE . 'boutique.php'; ?>" class="navbar-brand">Ma Boutique</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav  navbar-nav">
                        <?php
                        echo '<li><a href="'. RACINE_SITE .'boutique.php">Boutique</a></li>';
                        if(internauteEstConnecte()){    // Si membre est connecté
                            echo '<li><a href="'. RACINE_SITE .'profil.php">Profil</a></li>';
                            echo '<li><a href="'. RACINE_SITE .'connexion.php?action=deconnexion">Se deconnecter</a></li>';
                        }else{  // Sinon s'il n'est pas connecté
                            echo '<li><a href="'. RACINE_SITE .'inscription.php">Inscription</a></li>';
                            echo '<li><a href="'. RACINE_SITE .'connexion.php">Connexion</a></li>';
                        }
                            echo '<li><a href="'. RACINE_SITE .'panier.php">Panier ('. quantitePanier() .') </a></li>';
                        // Menu admin:
                            if(internauteEstConnecteEtEstAdmin()){
                                echo '<li><a href="'. RACINE_SITE .'admin/gestion_boutique.php">Gestion de la boutique</a></li>';
                                echo '<li><a href="'. RACINE_SITE .'admin/gestion_commande.php">Gestion des commandes</a></li>';
                                echo '<li><a href="'. RACINE_SITE .'admin/gestion_membre.php">Gestion des membres</a></li>';
                            }
                        ?>
                    </ul>
                </div>
            </div>  <!-- .container -->
        </nav>
        
        <div class="container" style="min-height: 80vh;">
            <!-- Ici il y a le contenu spécifique de chaque pages -->