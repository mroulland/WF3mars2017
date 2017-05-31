<?php

// mon-site.com/index.php?controller=membre&action=inscription
// mon-site.com/?controller=membre&action=inscription
// mon-site.com/membre/inscription

// mon-site.com/index.php?controller=produit&action=affiche&id=5
// mon-site.com/?controller=produit&action=affiche&id=5
// on-site.com/produit/affiche/5

// routing :
// $a = new Controller\ProduitController;
// $a -> affiche(5);
// // Lecture de l'url et retranscription. Le PHP traduit l'url et trouve le premier mot comme étant un controller puis le second comme étant la méthode à exécuter. 


// $a = new Controller\MembreController;
// $a -> inscription();

session_start();
require_once(__DIR__ . '/../vendor/autoload.php');

// TEST 1 : Entity Produit
// $produit = new Entity\Produit;
// $produit -> setTitre('Mon produit');
// echo $produit -> getTitre();

// TEST 2 : PDOManager
// $pdom = Manager\PDOManager::getInstance();
// $resultat = $pdom -> getPdo() -> query("SELECT * FROM produit");
// $produits = $resultat -> fetchAll(PDO::FETCH_ASSOC); 
// echo '<pre>';
// print_r($produits);
// echo '</pre>';

// TEST 3 : EntityRepository
$er = new Manager\EntityRepository;

// $resultat = $er -> findAll();
// $resultat = $er -> delete(5);

$produit = array(
    "id_produit" => NULL,
    "reference" => "dfkld",
    "categorie" => "kjfkj",
    "titre" => "sdkfk",
    "prix" => "15",
    "taille" => "S",
    "stock" => "10",
    "public" => "m",
    "photo" => "dsfsfs.jpg",
    "couleur" => "blanc",
    "description" => "djfj sjdkj sdjk pokspprq s"
);

// $resultat = $er -> register($produit);
$resultat = $er -> findAll();
echo '<pre>';
print_r($resultat);
echo '</pre>';