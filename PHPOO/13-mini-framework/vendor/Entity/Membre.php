<?php
//vendor/Entity/Membre.php 

namespace Entity;

class Membre
{
    private $id_membre;
    private $pseudo;
    private $mdp;
    private $nom;
    private $prenom;
    private $email;
    private $civilite;
    private $ville, $code_postal, $adresse, $statut; // Quand les propriétés sont toutes privates, on peut les noter côtes à côtes

    /* 
    GETTERS
    */
    public function getId_membre(){
        return $this -> id_membre;
    }

    public function getPseudo(){
        return $this -> pseudo;
    }

    public function getMdp(){
        return $this -> mdp;
    }

    public function getNom(){
        return $this -> nom;
    }

    public function getPrenom(){
        return $this -> prenom;
    }

    public function getEmail(){
        return $this -> email;
    }

    public function getCivilite(){
        return $this -> civilite;
    }

    public function getVille(){
        return $this -> ville;
    }

    public function getCode_postal(){
        return $this -> code_postal;
    }

    public function getAdresse(){
        return $this -> adresse;
    }

    public function getStatut(){
        return $this -> statut;
    }

    /*
    SETTERS
    */

    public function setId_membre($id_membre){
        $this -> id_membre = $id_membre;
    }

    public function setPseudo($pseudo){
        $this -> pseudo = $pseudo;
    }

    public function setMdp($mdp){
        $this -> mdp = $mdp;
    }

    public function setNom($nom){
        $this -> nom = $nom;
    }

    public function setPrenom($prenom){
        $this -> prenom = $prenom;
    }

    public function setEmail($email){
        $this -> email = $email;
    }

    public function setCivilite($civilite){
        $this -> civilite = $civilite;
    }

    public function setVille($ville){
        $this -> ville = $ville;
    }

    public function setCode_postal($code_postal){
        $this -> code_postal = $code_postal;
    }

    public function setAdresse($adresse){
        $this -> adresse = $adresse;
    }

    public function setStatut($statut){
        $this -> statut = $statut;
    }
    
}
