<?php

//controller/employesController.php

require __DIR__ . '/../model/employesModel.php'; 

class EmployesController
{
	public $model; // Contient notre objet model qui nous donne accès aux infos dans la table employes
	
	public function __construct(){
		$this -> model = new EmployesModel; 
	}

	public function afficheAllEmploye(){
		$employes = $this -> model -> getAllEmployes();
		require __DIR__ . '/../view/employesView.php';
	}
	
	public function afficheEmploye($id){
		
	}
	
	public function enregistreEmploye(){
		if(!empty($_POST)){
			// toutes les vérifications !! 
			
			$this -> model -> registerEmploye($_POST);
			require __DIR__ . '/../view/employeProfil.php'; 
			
		}	
	}
	
	public function modifieEmploye($id){
	
	}
	
	public function supprimeEmploye($id){
	
	}
}

$ec = new EmployesController; 
$ec -> afficheAllEmploye();




