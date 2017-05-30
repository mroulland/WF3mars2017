<?php

// 04-constante-static-self
    // Maison.class.php 

class Maison
{
    public $couleur = 'blanc';
    public static $espaceTerrain = '500m²';
    private $nbPorte = 10;
    private static $nbPiece = 7;
    const HAUTEUR = '10m';

    public function getNbPorte(){
        return $this -> nbPorte;
    }
    
    public static function getNbPiece(){
        return self::$nbPiece;
    }
}

// ----------------
echo 'Terrain : ' . Maison::$espaceTerrain . '<br>'; // OK! Je fais appel à un élément appartenant à la classe depuis la classe. 
// On place cette ligne avant pour prouver qu'il n'y a pas besoin d'instancier un objet de la classe pour pouvoir accéder à cette propriété. 
echo 'Pieces :' . Maison::$nbPiece . '<br>'; // ERREUR : Je fais appel à une propriété static via ma classe, mais elle est private donc innacessible à l'extérieur de la classe.
echo 'Pieces : ' . Maison::getNbPiece() . '<br>'; // OK je fais appel à un élément private via son getter static, donc par la classe. 
echo 'Hauteur : ' . Maison::HAUTEUR . '<br>'; // OK je fais appel à une propriété constante appartenant à la classe. 

$maison = new Maison;
echo 'Couleur : ' . $maison -> couleur . '<br>'; // OK ! Je fais appel à un élément de l'objet par l'objet. 
// echo 'Terrain : ' . $maison -> espaceTerrain . '<br>'; // ERREUR ! Je tente d'appeler un élément appartenant à la classe par l'objet. 
// echo 'Porte : ' . $maison -> $nbPorte . '<br>'; // ERREUR ! Je tente d'appeler une propriété private à l'extérieur de la classe. 
echo 'Portes : ' . $maison -> getNbPorte() . '<br>'; // OK ! Je fais appel à une propriété private via son getter qui lui est public et donc accessible à l'extérieur de la classe. 
// echo 'Pieces : ' . $maison -> nbPiece; // ERREUR : private donc innaccessible depuis l'extérieur ... Et en plus static donc innaccessible via l'objet. 


/* 
Commentaires : 
    Opérateurs : 
        - $objet ->     : élément d'un objet à l'extérieur de la classe
        - $this ->      : élément d'un objet à l'intérieur de la classe
        - Class::       : élément d'une classe à l'extérieur de la classe
        - self::        : élément d'une classe à l'intérieur de la classe 

    2 questions à se poser : 
        - estce que c'est static ?
            - Si oui : 
                Suis-je à l'intérieur de la classe ?
                    Si oui : self::
                    Si non : Class:: 

            - Si non : 
                Suis-je à l'intérieur de la classe ? 
                    Si oui : $this ->
                    Si non : $objet -> 

    static, signifie qu'un élément appartient à la classe. Pour y accéder, il faut l'appeler par la classe (Class:: ou self::) 

    const signifie qu'un élément appartient à la classe et ne sera jamais modifiable.

*/
