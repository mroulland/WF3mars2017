<?php

// 06-surcharge-abstraction-finalisation-interface-trait
    // -> surcharge.php 

// Surcharge ou override : permet de modifier le comportement d'une méthode héritée et d'y apporter des traitements supplémentaires.
// Surcharge != redéfinition. 

class A 
{
    public function calcul(){
        return 10;
    }
}

class B extends A // B hérite de A
{
    public function calcul(){
        // return $this -> calcul() + 5; // Ne fonctionne pas car s'appelle soit même : recursivité

        // return A::calcul() +5; // Ne fonctionne pas car calcul() n'est pas static. 

        return parent::calcul() + 5; // OK ! Permet d'appeler le comportement de la méthode calcul() telle que définie dans la classe parente.  
    } 
}