<?php

namespace Service;

use Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\User\User as User2;

class UserManager {
    /**
     *
     * @var $session 
     */
    private $session;
    
    /**
     * 
     * @param Session $session
     */
    
    public function __construct( Session $session )
    {
        $this->session = $session;
    }
    
    /**
     * Encode un mot de passe avec l'algo BCrypt
     * 
     * @param string $password
     * @return type
     */
    public function encodePassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    } // Une fois qu'on a crée un service, on va le déclarer en utilisation dans app
    
    
    /**
     * Vérifie la correspondance entre un mdp en clair et un mdp encodé
     * 
     * @param string $plainPassword
     * @param string $encodePassword
     * @return bool
     */
    public function verifyPassword($plainPassword, $encodePassword)
    {
        return password_verify($plainPassword, $encodePassword);  
    }
    
    /**
     * 
     * @param User2 $user
     */
    public function login(User $user)
    {
        $this->session->set('user', $user);
    }
    
    public function logout(){
        $this->session->remove('user');
    }
    
    /**
     * 
     * @return bool
     */
    public function isUserConnected()
    {
        // On vérifie s'il y a un utilisatuer connecté
        return $this->session->has('user');
    }
    
    /**
     * 
     * @return User|null
     */
    public function getUser()
    {
        // Methode pour récupérer l'utilisateur connecter
        if($this->isUserConnected()){
            return $this->session->get('user');
        }
        
    }
    
    public function getUsername()
    {
        if ($this->isUserConnected()){
            return $this->session->get('user')->getFullname();
        }
        return '';
    }
    
    /**
     * 
     * @return bool
     */
    public function isAdmin()
    {
        return $this->isUserConnected() && $this->session->get('user')->isAdmin();
    }
}
