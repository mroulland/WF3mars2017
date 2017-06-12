<?php

use Repository\ArticleRepository;
use Repository\CategoryRepository;
use Repository\UserRepository;
use Service\UserManager;
use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\ValidatorServiceProvider;

/* Service providers */

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // pour avoir accès au service UserManager dans les templates
    // En paramètres : le nom de la globale, et ce qu'elle va contenir 
    // Ca va correspondre à notre instance de la classe UserManager et donc toutes les méthodes qu'on a crée jusqu'ici
    $twig->addGlobal('user_manager', $app['user.manager']); 

    return $twig;
});

// Ajout doctrine DBAL
// on doit ensuite exécuter
// composer require "doctrine/dbal:~2.2"
// en ligne de commande dans le répertoire de l'application
$app->register(
    new DoctrineServiceProvider(), 
    [
        'db.options' => [
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'dbname' => 'silex_blog',
            'user' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ]
    ]
);

$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider);


/* Services qui sont des Repositories */
$app['category.repository'] = function () use ($app) {
    return new CategoryRepository($app['db']);
};

$app['article.repository'] = function () use ($app) {
    return new ArticleRepository($app['db']);
};

$app['user.repository'] = function () use ($app) {
    return new UserRepository($app['db']);
};

/* Services autres */ 
$app['user.manager'] = function () use ($app){
    return new UserManager($app['session']);
};

return $app;
