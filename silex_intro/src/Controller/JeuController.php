<?php

namespace Controller;

use Silex\Application;

class JeuController {
    
    public function jeuAction(Application $app){
        
        if(!empty($_POST)){
            if($_POST['code'] === 'mot de passe'){
                return $app['twig']->render('reponse.html.twig');
            }
            else{
                $message = 'Réponse incorrecte.' ; 
            }
        }
        
        
        return $app['twig']->render('jeu.html.twig');
    }
    
    
    public function reponseAction(Application $app){
        return $app['twig']->render('reponse.html.twig');
    }
}
