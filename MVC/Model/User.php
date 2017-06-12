<?php

namespace Model;

use App\Cnx;

class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $lastname;
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $address;
    
    public function __construct(
        $id = null, 
        $lastname = null, 
        $firstname = null, 
        $email = null, 
        $address = null) 
    {
        $this->id = $id;
        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->address = $address;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }
    
    /**
     * Méthode qui retourne tous les utilisateurs enregistrés en BDD
     * @return array Un tableau d'objets User 
     */
    public static function findAll()
    {
        $pdo = Cnx::getInstance(); 
        $query = 'SELECT * FROM user ORDER BY id';
        $stmt = $pdo->query($query);
        $dbUsers = $stmt->fetchAll();  
        // On a déjà préciser qu'on était automatiquement en fetch_assoc donc pas besoin de remplir les parenthèses
        $users = [];
        
        foreach($dbUsers as $dbUser){
            $user = new self(
                $dbUser['firstname'],
                $dbUser['lastname'],
                $dbUser['email'],
                $dbUser['address'],
                $dbUser['id']
            );
            
            $users[] = $user; 
        }
        return $users; 
    }


}