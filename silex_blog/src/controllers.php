<?php

use Controller\Admin\ArticleController;
use Controller\Admin\CategoryController;
use Controller\IndexController;
use Controller\UserController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/* Front */

$app['index.controller'] = function () use ($app) {
    return new IndexController($app);
};

$app
    ->get('/', 'index.controller:indexAction')
    ->bind('homepage')
;

$app
    ->get('/rubriques', 'index.controller:categoriesAction')
    ->bind('categories')
;

$app
    ->get('/rubriques/{id}', 'index.controller:categorieAction')
    ->assert('id', '\d+')
    ->bind('category')
;

/* Utilisateurs */

/* On déclare nos utilisateurs en service */
$app['user.controller'] = function () use ($app) {
    return new UserController($app);
};

// C'est une route qui va contenir un formulaire donc il faut un match
$app
    ->match(
        'utilisateur/inscription', 
        'user.controller:registerAction'
    )
    // Nom de la route
    ->bind('register')
;

$app
    ->match(
        // Match accepte les retours en POST ET GET (donc idéal pour les formulaires)
        'utilisateur/connexion', 
        'user.controller:loginAction'
    )
    // Nom de la route
    ->bind('login')
;

$app
    // get accepte uniquement les requêtes HTTP en GET (donc via le lien)
    ->get(
        'utilisateur/deconnexion',
        'user.controller:logoutAction'
    )
    ->bind('logout')
;

/* Admin */ 
$app['admin.category.controller'] = function () use ($app) {
    return new CategoryController($app);
};

//créer un sous-ensemble de routes
$admin = $app['controllers_factory'];

$admin->before(function () use ($app) {
   // Grace à la fonction before, tout ce qui va se trouver dans la fonction anonyme va se dérouler avant l'accès à la route 
   // Permet de faire un traitement avant d'arriver dans l'admin
   if (!$app['user.manager']->isAdmin()){ // Si un admin n'est pas connecté 
       $app->abort(403, 'Accès refusé'); // HTTP 403 Forbidden
       // abort est une fonction qui arrête tout, et renvoie vers l'erreur correspondante ici 'accès refusé'
   }
});


// Toutes les routes du sous-ensemble commenceront par /admin
$app->mount('/admin', $admin);

$admin
    ->get('rubriques', 'admin.category.controller:listAction')
    ->bind('admin_categories')
;

// Route pour la page d'édition des rubriques
$admin
    ->match(
        '/rubriques/edition/{id}', 
        'admin.category.controller:editAction'
    )
    // valeur par défaut pour le paramètre de la route
    ->value('id', null)
    ->bind('admin_category_edit')
;

$admin
    ->get(
        '/rubriques/suppression/{id}', 
        'admin.category.controller:deleteAction'
    )
    ->bind('admin_category_delete')
;

/*
 * Créer la partie admin pour les articles :
 * - Créer le contrôleur Admin\ArticleController
 * - le définir en service
 * - on y ajoute la méthode listAction à vide
 * - puis la route qui pointe dessus
 * - on ajoute le lien vers cette route dans la navbar admin
 * - on crée l'entity Article et le repository ArticleRepository
 * - on déclare le ArticleRepository en service dans app.php
 * - on remplit la méthode listAction du contrôleur en utilisant ArticleRepository
 * - on crée la vue qui affiche les articles dans un tableau html
 */
// Déclaration de service pour le controler
$app['admin.article.controller'] = function () use ($app) {
    return new ArticleController($app);
};

// Route pour la liste
$admin   ->get('/articles', 'admin.article.controller:listAction')
    ->bind('admin_articles')
;

// Route pour l'édition de la page articles
$admin
    ->match(
        '/articles/edition/{id}', 
        'admin.article.controller:editAction'
            // On donne le chemin, dans admin > article > on appelle le controller et on lui demande la méthode editAction
    )
    // valeur par défaut pour le paramètre id de la route pour pouvoir l'utiliser en création et modification
    ->value('id', null)
    // Si la valeur est précisée, ce doit être un nombre \d+ est l'expéression régulière qui veut dire "un nombre décimal" et le + indique qu'on peut en mettre plusieurs
    // Assert prend comme paramètre une variable défini dans la route, ici on a mis id en paramètre optionnel
    // Si on rentre autre chose qu'un nombre, la route sera invalide et renverra vers une error 404. 
    ->assert('id', '\d+')
    ->bind('admin_article_edit')
;

$admin
    ->get(
        '/articles/suppression/{id}', 
        'admin.article.controller:deleteAction'
    )
    ->bind('admin_article_delete')
;


$app->error(function (Exception $e, Request $request, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});
