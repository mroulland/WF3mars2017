<?php
//vendor/Manager/PDOManager.php 

namespace Manager;
use PDO; // On récupère la classe PDO appartenant à l'espace global de PHP. Sans cela nous devrions appeler PDO comme cela : \PDO pour sortir de l'espace Manager. 

class PDOManager
{
    private static $instance = NULL;
    protected $pdo; // Contiendra notre objet PDO (connexion à la BDD)
    
    private function __construct(){} // On la met en private pour s'assurer que la classe ne soit pas instanciable 
    private function __clone(){} // La classe n'est plus clonable

    public static function getInstance(){    
        if(!self::$instance){
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getPDO(){
        
        include_once(__DIR__ . '/../../app/Config.php');
        $config = new \Config; 
        $connect = $config -> getParametersConnect(); 

        try{
            $this -> pdo = new PDO('mysql:host='. $connect['host'] .';dbname='. $connect['dbname'], $connect['login'], $connect['password'], array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        catch(PDOException $e){
            echo '<div style="background:red; color:white; padding:20px;">';
            echo 'Vous avez une erreur de connexion à la BDD : <br>';
            echo '<b><u>Message</u></b> :' . $e -> getMessage();
            echo '<b><u>Fichier</u></b> :' . $e -> getFile();
            echo '<b><u>Ligne</u></b> :' . $e -> getLine();
            echo '</div>'; 
            exit;
        }

        return $this -> pdo;
    }
// $pdo = new PDO('','',''); // Technique en procédural
// $pdo = PDOManager::getInstance() -> getPdo(); // Technique en objet

}