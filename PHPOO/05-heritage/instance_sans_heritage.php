<?php
// 05-Heritage
    // -> instance_sans_heritage.php

class C{}

class A
{
    public function bonjour(){
        return 'Bonjour !';
    }
}
// ----------
class B extends C{ // B n'hérite pas de A !!! 
    public $maVariable; 

    public function __construct(){
        $this -> maVaribale = new A; 
        // Au moment de l'instanciation de B, on met dans $maVariable un objet de la classe A. 
    }
}
// ----------
$b = new B;
echo $b -> maVariable -> bonjour();

// revient à faire : 
// $maVariable = new A;
// $maVariable -> bonjour();
// $b -> maVariable -> bonjour();

/* 
Commentaires : 
    nous avons un objet dans un objet, d'où l'utilisation deux flèches successibement. $x -> y -> methode();

    L'intérêt d'avoir une instance sans héritage (récupérer un objet dans la propriété d'une classe) est de pouvoir hériter d'une classe mère d'un côté tout en ayant la possibilité de récupérer les éléments d'une autre classe en même temps.
*/