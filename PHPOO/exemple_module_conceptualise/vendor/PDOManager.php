<?php

// Ce fichier permet de récupérer les infos de connexion (parameters) et un objet PDO qui sera la connexion à la BDD. SINGLETON !! 

class PDOManager 
{
	private static $instance = NULL; 
	private $pdo; //contiendra ma connexion à la BDD
	
	private function __construct(){}
	private function __clone(){}
	
	public static function getInstance(){
		if(is_null(self::$instance)){
			self::$instance = new self;
			// self::$instance = new PDOManager; // idem ! 
		}
		return self::$instance; 	
	}
	
	public function getPdo(){
		require __DIR__ . '/parameters.php';
		$this -> pdo = new PDO('mysql:host=' . $parameters['host'] . ';dbname=' . $parameters['dbname'] , $parameters['login'], $parameters['password']);
		
		return $this -> pdo; 
	}
}