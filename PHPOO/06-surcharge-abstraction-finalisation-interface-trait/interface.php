<?php
// 06-surcharge-abstraction-finalisation-interface-trait
    //-> interface.php 

interface Mouvement
{
    public function start(); // Dans une interface les méthodes n'ont pas de contenu
    public function turnRight();
    public function turnLeft(); 
}

class Bateau implements Mouvement // On n'utilise pas extens mais implements dans le cadre des interfaces. 
{
    public function start(){ // OBLIGATION de définir TOUTES les méthodes récupérées via l'implémentation de l'interface.  

    }

    public function turnRight(){

    }

    public function turnLeft(){

    }
}

class Avion implements Mouvement 
{
    public function start(){ // OBLIGATION de définir TOUTES les méthodes récupérées via l'implémentation de l'interface.  

    }

    public function turnRight(){

    }

    public function turnLeft(){

    }

}

/* 
Commentaires : 
    - Une interface est une liste de méthodes (sans contenu) qui permets de garantir que toutes les classes qui vont imlplémenter l'interface contiendront les mêmes méthodes, et la même sémantique. C'est une sorte de contrat passé entre le dev'' maître et les autres dev'. Plan de fabrication d'une classe.

    - Une interface n'est pas intanciable. 
    - Une classe peut implémenter plusieurs interfaces
    - Une classe peut à la fois extends une autre classe et implents une ou plusieurs interface(s).
    - Les méthodes d'une interface doivent forcément être public sinon elles ne peuvent pas être définies.  

*/