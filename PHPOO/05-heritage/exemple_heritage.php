<?php

// 05-Heritage
    // -> exemple_heritage.php 

class Membre
{
    public $id_membre;
    public $pseudo;
    public $email;

    public function inscription(){
        return 'Je m\'inscris !';
    }

    public function connexion(){
        return 'Je me connecte !';
    }
}

// --------------
class Admin extends Membre // extends signifie "hérite de "
{
    // Tout le code de Membre est ici !!! 

    public function accesBackOffice(){
        return 'J\'ai accès au backOffice'; 
    }
}

// --------------
$admin = new Admin;
echo $admin -> inscription() . '<br>';
echo $admin -> connexion() . '<br>';
echo $admin -> accesBackOffice() . '<br>';