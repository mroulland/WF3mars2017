<?php

// 06-surcharge-abstraction-finalisation-interface-trait
    // -> abstraction.php 

class Joueur
{
    public function seConnecter(){
        return $this -> etreMajeur();
    }

    abstract public function etreMajeur(); // une méthode abstraite n'a pas de contenu. 
}

// ----------
class JoueurFr extends Joueur 
{
    public function etreMajeur(){
        return 18;
    }

}
// ----------
class JoueurUS extends Joueur
{
    public function etreMajeur(){
        return 21;
    }

}

// ------------
$fr = new JoueurFr;
echo $fr -> seConnecter() . '<br>';

$us = new JoueurFr;
echo $us -> seConnecter() . '<br>';

/* 
Commentaires : 
    - Une classe abstraite ne peut pas être instanciée. 
    - Les méthodes abstraites n'ont pas de contenu 
    - Pour déclarer une méthode abstraite on doit obligatoirement être dans une classe abstraite. 
    - Une classe abstraite peut contenir des méthodes normales. 
    - Lorsqu'on hérite d'une classe abstraite, on doit OBLIGATOIREMENT redéfinir les méthodes abstraites. 

    Le développeur maître, qui est coeur de l'application, va obliger les autres développeur à redéfinir des méthodes. Ceci est une bonne pratique dans le cadre d'un travail collaboratif et hierarchisé. 
*/