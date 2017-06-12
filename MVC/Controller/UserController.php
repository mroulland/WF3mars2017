<?php
namespace Controller;

use Lib\ViewRenderer;
use Model\User;

class UserController 
{
   public function listAction()
   {
       $users = User::findAll();
       
       $viewRenderer = ViewRenderer::getInstance();
       $viewRenderer->render(
               'index.view.php',
               ['users' => $users]
        );
       // On appelle le modele, qu'on passe à la vue pour lancer l'affichage
   }
   
   public function editAction()
   {
       echo 'user:edit';
   }
}
