<?php
//vendor/autoload.php 

class Autoload 
{
    public static function className($nom_de_la_classe){
        // $pc = new Controller\ProduitController; 
        // require 'Controller/ProduitController.php'

        $tab = explode('\\', $nom_de_la_classe);

        // $cont = new Controller\Controller;

        // "0" => Controller
        // "1" => ProduitController

        if($tab[0] == 'Controller' && $tab[1] != 'Controller'){
            $path = __DIR__ . '/../src/' . implode('/', $tab) . '.php';
        } 
        else{
            $path = __DIR__ . '/' . implode('/', $tab) . '.php';
        }

        require $path; 

        echo '<pre>Autoload : ' . $nom_de_la_classe . '<br>';
        echo '=> ' . $path . '</pre><hr>';
    }


}



// ----------------------------
spl_autoload_register(array('Autoload', 'className'));
// ----------------------------
// En objet, spl_auotoload_register a besoin du nom de la class et de la méthode à exécuter. On passe donc un array. 
// Attention, notre méthode doit OBLIGATOIREMENT être static. 
