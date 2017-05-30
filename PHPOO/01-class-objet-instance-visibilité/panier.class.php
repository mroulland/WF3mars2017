<?php





class Panier
 {
     public $nbProduit;  // déclaration d'une variable public. Propriété (variable) : on annonce que dans le plan de fabrication d'un panier il va y avoir une variable nombre de produits


     public function ajouterProduit(){
         // traitement de la méthode
         return 'L\'article a bien été ajouté au panier !';
     }
    
    protected function retirerProduit(){
        return 'L\'article a été retiré du panier !';
    }

    private function affichagePanier(){
        return 'Voici les produits dans le panier !';
    }
 }
// -------------------------
$panier = new Panier;  // instanciation : création d'un objet d'une classe. $panier représente un objet de la classe panier. 
var_dump($panier);  // object(Panier)#1 (1) { ["nbProduits"]=> NULL } 
// En réalité, la variable panier ne contient pas tous les éléments de la classe objet mais simplement une référence. 
var_dump(get_class_methods($panier)); // permet d'afficher les méthodes propres à une classe. Cela n'affiche qu'un seul résultat car une seule des fonctions est en public. Les deux autres sont protégée ou privée. 

$panier -> nbProduit = 5; // La flèche -> permet d'appeler une méthode sur un objet 
// Quand on utilise une propriété, on utilise pas le $. On déclare une propriété comme une variable mais quand on l'appelle elle ne prend pas de $ après la -> 
echo 'Nombre de produits : ' . $panier -> nbProduit . '<br>';

echo '<pre>'; var_dump($panier); echo '</pre>';

echo 'Panier : ' . $panier -> ajouterProduit() . '<br>';
// echo 'Panier : ' . $panier -> retirerProduit() . '<br>'; // ERREUR : Impossible d'accéder à une méthode ou un élément protected à l'extérieur de la classe. 

// echo 'Panier : ' . $panier -> affichagePanier() . '<br>'; // ERREUR : Impossible d'accéder à un élément private à l'extérieur 

$panier2 = new Panier;
echo '<pre>'; var_dump($panier2); echo '</pre>';  // On voit qu'il est numéroté #2. La valeur nbProduit est bien redevenue nulle, car dans le plan de construction elle ne contient pas de valeur. 

/* 
Commentaires : 
    New : est un mot clé qui permet de créer un objet issu d'une classe (instanciation) 

    On peut créer plusieurs objets d'une même classe. Et lorsqu'on affecte une valeur à une propriété d'un objet, cela n'a pas d'incidence sur les autres objets de la classe. 

    Niveau de visibilité : 
        - public : Accessible de partout !
        - protected :  Accessible depuis la classe où l'élément à été déclaré ainsi que depuis les classes héritières
        - private : Accessible UNIQUEMENT depuis la classe où l'élément a été déclaré. 
*/