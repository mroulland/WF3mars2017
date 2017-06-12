<?php

//vendor/Repository/ProduitRepository.php 

namespace Repository;

use Manager\EntityRepository; // /!\ Très important car l'hésitage ne permet pas de charger le fichier. Il n'y a pas d'autoload dans l'héritage. 
use PDO;



class ProduitRepository extends EntityRepository
{
    // Tout le code de EntityRepository est ici !! 
    public function getAllProduits(){
        return $this -> findAll(); // methode générique déclarée dans EntityRepository. On crée donc une nouvelle méthode qui utilise une précédente. 
    }

    public function getProduitById($id){  // Suite de la récupération des requêtes génériques déclarée dans EntityRepository et qu'on réutilise ici pour produit
        return $this -> find($id);
    }

    public function deleteProduitById($id){
        return $this -> delete($id);
    }

    public function registerProduit($infos){
        return $this -> register($infos);
    }

    // Requêtes spécifiques à cette entité Produit : $ 

    public function getAllCategories(){
        $requete = "SELECT DISTINCT categorie FROM produit";
        $resultat = $this -> getDb() -> query($requete);

        $categories = $resultat -> fetchAll(PDO::FETCH_ASSOC);

        if(!$categories){
            return FALSE;
        }
        else{
            return $categories;
        }
    }

    public function getAllProduitsByCategorie($categorie){
        $requete = "SELECT * FROM produit WHERE categorie = :categorie";
        $resultat = $this -> getDb() -> prepare($requete); 
        $resultat -> bindParam(':categorie', $categorie, PDO::PARAM_STR); 
        $resultat -> execute(); 

        $produitsByCategorie = $resultat -> fetchAll(PDO::FETCH_ASSOC);
        
        if(!$produitsByCategorie){
            return FALSE;
        }
        else{
            return $produitsByCategorie; 
        }
    }

    public function getAllSuggestions($categorie, $id){
        $requete ="SELECT * FROM produit WHERE categorie = '$categorie' AND id_produit != $id"; // $categorie prend des quotes car on passe un string alors que $id est un entier.  On peut mettre des '' autour d'un entier. 
        $resultat = $this -> getDb() -> query($requete);

        $suggestions = $resultat -> fetchAll(PDO::FETCH_ASSOC);

        if(!$suggestions){
            return FALSE;
        }
        else{
            return $suggestions;
        }
    }
}