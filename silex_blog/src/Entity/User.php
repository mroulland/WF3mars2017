<?php

namespace Entity;

class User {
    
    // On déclare les variables issues de la BDD
    
    /**
     *
     * @var int
     */
    private $id;
    
    /**
     *
     * @var string
     */
    private $lastname;
    
    /**
     *
     * @var string
     */
    private $firstname;
    
    /**
     *
     * @var string
     */
    private $email;
    
    /**
     *
     * @var string
     */
    private $password;
    
    /**
     *
     * @var string
     */
    private $role;
    
    // On génère les getters et setters avec ALT + INSER
    
    /**
     * 
     * @return int
     */
    public function getId() 
    {
        return $this->id;
    }
    
    /**
     * 
     * @return string
     */
    public function getLastname() 
    {
        return $this->lastname;
    }
    
    /**
     * 
     * @return string
     */
    public function getFirstname() 
    {
        return $this->firstname;
    }
    
    /**
     * 
     * @return string
     */
    public function getEmail() 
    {
        return $this->email;
    }
    
    /**
     * 
     * @return sting
     */
    public function getPassword() 
    {
        return $this->password;
    }
    
    /**
     * 
     * @return string
     */
    public function getRole() 
    {
        return $this->role;
    }
    
    /**
     * 
     * @return string
     */
    public function getFullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    
    public function isAdmin()
    {
        return $this->role == 'admin';
    }
    
    /**
     * 
     * @param int $id
     * @return $this
     */
    public function setId($id) 
    {
        $this->id = $id;
        return $this;
    }
    
    /**
     * 
     * @param string $lastname
     * @return $this
     */
    public function setLastname($lastname) 
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * 
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname) 
    {
        $this->firstname = $firstname;
        return $this;
    }
    
    /**
     * 
     * @param string $email
     * @return $this
     */
    public function setEmail($email) 
    {
        $this->email = $email;
        return $this;
    }
    
    /**
     * 
     * @param string $password
     * @return $this
     */
    public function setPassword($password) 
    {
        $this->password = $password;
        return $this;
    }
    
    /**
     * 
     * @param string $role
     * @return $this
     */
    public function setRole($role) 
    {
        $this->role = $role;
        return $this;
    }

    
}
