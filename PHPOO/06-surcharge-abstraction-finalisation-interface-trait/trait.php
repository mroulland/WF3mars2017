<?php
// 06-surcharge-abstraction-finalisation-interface-trait
    //-> trait.php 

// Attention : Les traits ne fonctionnent que depuis PHP 5.4

trait TPanier // Par convention, on met toujours un T majuscule avant son nom
{
    public $nbproduit = 1;

    public function affichageProduits(){
        return 'Affichage des produits dans le panier'; 
    }
}

// --------------
trait TMembre 
{
    public function affichageMembres(){
        return 'Affichage des membres'; 
    }
}

// --------------
class Site
{
    use TPanier, TMembre;
    // use permets d'importer le code contenu dans un ou plusieurs traits. 
}

// --------------

$site = new Site;
echo $site -> affichageProduits() . '<br>';
echo $site -> affichageMembres() . '<br>';

/* 
Commentaires : 
    - Les traits permettent d'importer du code dans une classe
    - Ils ont été inventés pour repousser l'héritage non multiple
    - Une classe peut importer plusieurs traits
    - Un trait peut importer un trait
*/
