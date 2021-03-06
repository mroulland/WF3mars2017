<?php

namespace Controller;

use Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
// Toutes les classes qui sont dans Symfony\ seront disponibles dans Assert\ 
// Constraints, c'est le nom du NAMESPACE (et non pas d'une classe) qui contient toutes ces classes là

class UserController extends ControllerAbstract 
{
    public function registerAction()
    {
        // On instancie un nouvel utilisateur via la class User prise dans Entity\User et on stocke l'objet dans $user
        $user = new User();
        $errors = []; // On déclare un tableau d'erreurs à vide

        
        // On demande, si le formulaire a été posté
        // Si c'est le cas, on appelle et modifie les variables contenues dans l'objet $user grâce aux setters
        if(!empty($_POST)){
            
            // Validation 
            if(!$this->validate($_POST['lastname'], new Assert\NotBlank())){ // Appelle d'une méthode NotBlank stockée dans Symfony\Component\Validator\Constraints
                $errors['lastname'] = 'Le nom est obligatoire';
            }
            
            if(!$this->validate($_POST['firstname'], new Assert\NotBlank())){ 
                $errors['firstname'] = 'Le prénom est obligatoire';
            }
            
            if(!$this->validate($_POST['email'], new Assert\NotBlank())){ 
                $errors['email'] = 'L\'email est obligatoire';
            } elseif(!$this->validate($_POST['email'], new Assert\Email())){
                $errors['email'] = "L'email n'est pas valide";
            }
            
            if(!$this->validate($_POST['password'], new Assert\NotBlank())){ 
                $errors['password'] = 'Le mot de passe est obligatoire';
            }
            
            if(empty($errors)){
                $user
                    ->setLastname($_POST['lastname'])
                    ->setFirstname($_POST['firstname'])
                    ->setEmail($_POST['email'])
                    // On va créer un service pour encoder le mot de passe (qu'on retrouvera dans Service / UserManager
                    ->setPassword($this->app['user.manager']->encodePassword($_POST['password']))
                ;
            
                $this->app['user.repository']->insert($user);
                $this->app['user.manager']->login($user); // Pour connecter automatiquement l'utilisateur inscrit
            
                return $this->redirectRoute('homepage'); // Et on le redirige vers la page d'accueil
            } else{
                $msg = '<strong>Le formulaire contient des erreurs</strong>';
                $msg .= '<br>-' .  implode('<br>-', $errors);
                
                $this->addFlashMessage($msg, 'error');
            }
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
