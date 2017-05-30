<?php

//model/employesModel.php

require __DIR__ . '/../vendor/PDOManager.php';

class EmployesModel
{
	private $db; 
	
	public function getDb(){
		$this -> db = PDOManager::getInstance() -> getPDO(); 
		return $this -> db; 
	}

	public function getAllEmployes(){
		$requete = "SELECT * FROM employes";
		$resultat = $this -> getDb() -> query($requete); 
		
		$employes = $resultat -> fetchAll(PDO::FETCH_ASSOC);
		
		if(!$employes){
			return FALSE; 
		}
		else{
			return $employes;
		}
	}
	
	public function getEmployeById($id){
		$requete = "SELECT * FROM employes WHERE id_employes = :id";
		
		$resultat = $this -> getDb() -> prepare($requete);
		$resultat -> bindParam(':id', $id, PDO::PARAM_INT);
		$resultat -> execute(); 
		
		$employe = $resultat -> fetch(PDO::FETCH_ASSOC);
		
		if(!$employe){
			return FALSE; 
		}
		else{
			return $employe;
		}
	}
	
	public function registerEmploye(array $employe){
		// Requete INSERT ! 
	}
	
	public function deleteEmployeById($id){
		// REQUETE DELETE WHERE id_employes = $id
	}
	
	public function udpdateEmployeById($id){
		// REQUETE UDPDATE ... WHERE id_employes = $id
	}
	
}