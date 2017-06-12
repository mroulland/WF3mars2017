<?php

namespace Controller;

use Entity\User;

class UserController extends ControllerAbstract 
{
    public function registerAction()
    {
        // On instancie un nouvel utilisateur via la class User prise dans Entity\User et on stocke l'objet dans $user
        $user = new User();
        
        // On demande, si le formulaire a été posté
        // Si c'est le cas, on appelle et modifie les variables contenues dans l'objet $user grâce aux setters
        if(!empty($_POST)){
            $user
                ->setLastname($_POST['lastname'])
                ->setFirstname($_POST['firstname'])
                ->setEmail($_POST['email'])
                // On va créer un service pour encoder le mot de passe (qu'on retrouvera dans Service / UserManager
                ->setPassword($this->app['user.manager']->encodePassword($_POST['password']))
            ;
            
            $this->app['user.repository']->insert($user);
        }
        
        return $this->render('register.html.twig');
    }
    
    public function loginAction()
    {
        // On rajoute la route vers cette méthode dans Controllers et on crée la vue
        
        $email = '';
        // En cas d'erreur d'identification, on pré-remplit le champ pour le retour
        
        if (!empty($_POST)){
            $email = $_POST['email'];
            
            $user = $this->app['user.repository']->findByEmail($email);
            
            if(!is_null($user)){ // S'il y a un utilisateur en bdd avec cet email
                // si le mot de passe saisi correspond à celui stocké en bdd
                if($this->app['user.manager']->verifyPassword($_POST['password'], $user->getPassword())){
                    $this->app['user.manager']->login($user);
                    
                    return $this->redirectRoute('homepage');
                }
            }
            
             $this->addFlashMessage('Identification incorrecte', 'error');
        }
  
        return $this->render(
            'login.html.twig',
            ['email' => $email]
        ); 
    }
    
    public function logoutAction()
    {
        $this->app['user.manager']->logout();
        
        return $this->redirectRoute('homepage');
    }
}
