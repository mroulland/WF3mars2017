<?php

use Controller\FirstController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//Request::setTrustedProxies(array('127.0.0.1'));

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig', array());
})
->bind('homepage')
;
// On appelle la méthode get qui définit la route en premier argument (ici l'index) 
// puis une fonction anonyme (ou fonction callback) qui s'exécute quand il trouve le bon chemin.
// cette fonction exécute twig et la méthode render qui permet d'afficher sur la route 
// en question le contenu de la page index.html, dans l'array on trouve les paramètres qui seront disponibles dans l'affichage de cette vue


$app->get('/hello', function() use ($app){
    return $app['twig']->render('hello.html.twig', array());
})
->bind('hello')
;
// On fait une route dont le chemin est /hello et qui va appeler notre moteur de template pour afficher la vue
// nommage en trois parties .twig car c'est une application qui rend le fichier, 
// et .html parce que twig peut rendre des vues de fichiers autres qu'HTML donc on précise. 
// ->bind = on appelle la vue



/**
 * name est une variable dans l'url, 
 * passée à la fonction annonyme qui sert de controleur
 * puis à la vue dans la méthode render de twig
 */
$app->get('/hello/{name}', function ($name) use ($app){
    return $app['twig']->render(
            'hello_world.html.twig',
            ['name' => $name]
            );
})
->bind('hello_world')
;

$app->get('/twig', function () use ($app){
    return $app['twig']->render(
            'twig.html.twig',
            ['myvar' => 'Ma variable']
    );
})
->bind('twig')
;

// Déclaration du controler en service dans l'application
$app['first.controller'] = function(){
    return new FirstController();
};

// utilisation du contrôleur dans une route
$app 
    ->get('/test', 'first.controller:testAction')
    ->bind('test')
; // On utilise toujours le get pour définir la route, sauf qu'on n'utilise plus une fonction
// anonyme mais une methode définie dans la classe FirstController;

// $name sera passé à la méthode testParamAction
$app 
    ->get('/test/{name}', 'first.controller:testParamAction')
    ->bind('test_param')
;

$app
    ->get('/users', 'first.controller:usersAction')
    ->bind('users')
;

$app
    ->get('/user/{userId}', 'first.controller:userAction')
    ->bind('user')
;


$app->error(function (\Exception $e, Request $request, $code) use ($app) {
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
