<?php
// 05-Heritage
    // -> heritage_sens.php

// Transitivité : Si une classe B hérite d'une classe A et qu'une classe C hérite de la classe B, alors C hérite de A. 

class A
{
    public function testA(){
        return 'Test A';
    }
}
// ------

class B extends A 
{
    public function testB(){
        return 'Test B';
    }
}
// ------

class C extends B
{
    public function testC(){
        return 'Test C';
    }
}
// ------

$c = new C;
echo $c -> TestA() . '<br>'; // méthode de A accessible par C (héritage indirect)
echo $c -> TestB() . '<br>'; // méthode de B accessible par C (héritage direct)
echo $c -> TestC() . '<br>'; // méthode de C accessible par C

var_dump(get_class_methods($c)); // Affiche les trois méthodes, car elles appartiennent toutes à C. 

/* 
Commentaires : 
    Transitivité : 
        Si B hérite de A
            Et que C hérite de B ...
                ... Alors C hérite de A. 
        Les méthodes protected de A sont également disponibles dans C, même si l'héritage est indirect. 

    L'héritage est :
        - non reflexif : class D extends D : une classe ne peut pas hériter d'elle même. 
        - non-symétrique : Si class F extends E, alors E n'est pas extends de F automatiquement. 
        - Sans cycle : Si class F extends E, alors il est impossible que E extends F. 
        - Non multiple : Class N extends M, P : IMPOSSIBLE en PHP. Pas d'héritage multiple en PHP !!! 
*/

