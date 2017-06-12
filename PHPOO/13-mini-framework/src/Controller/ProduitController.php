<?php

//src/Controller/ProduitController.php 

namespace Controller;

use Controller\Controller; 

class ProduitController extends Controller
{
    public function afficheAll(){
        $produits = $this -> getRepository() -> getAllProduits(); // Le controller a récupéré tous les produits dans un tableau multi dimensionnel
        $categories = $this -> getRepository() -> getAllCategories(); // J'ai récupéré toutes les catégories existantes dans mon site

        // $this -> render(); // Cette méthode affichera la vue 
        // require('');

        // echo '<pre>';
        // print_r($produits);
        // print_r($categories);
        // echo '</pre>';

        // require(__DIR__ . '/../View/Produit/boutique.php');

        $params = array(
            'produits' => $produits,
            'categories' => $categories,
            'title' => 'Boutique de mon site'
        );

        return $this -> render('layout.html', 'boutique.html', $params);
    }

    public function affiche($id){
        $produit = $this -> getRepository() -> getProduitById($id); 
        $suggestions = $this -> getRepository() -> getAllSuggestions($produit['categorie'], $produit['id_produit']); 

        // $this -> render();

        // echo '<pre>';
        // print_r($produit);
        // print_r($suggestions);
        // echo '</pre>';

        require(__DIR__ . '/../View/Produit/fiche_produit.php');
    }

    public function categorie($categorie){
        $produits = $this -> getRepository() -> getAllProduitsByCaregorie($categorie); 
        $categories = $this -> getRepository() -> getAllCategories(); 

        // $this -> render();

        // echo '<pre>';
        // print_r($produits);
        // print_r($categories);
        // echo '</pre>';

        require(__DIR__ . '/../View/Produit/categorie.php');
    }

}