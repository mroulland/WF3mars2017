<?php 

// 02-getter-setter-constructeur-this
    //-> Membre.class.php 

class Membre
{
    private $pseudo;
    private $mdp;

    public function setPseudo($pseudo){
        if(!empty($pseudo) && is_string($pseudo) && strlen($pseudo) > 3 && strlen($pseudo) < 20){
            $this -> pseudo = $pseudo;
        }
    }
    
    public function getPseudo(){
        return $this -> pseudo;
    }

    public function setMdp($mdp){
        if(!empty($mdp) && is_string($mdp) && strlen($mdp) > 8){
            $salt = 'azerty' . time();  // on utilise comme clé de codage une chaine de caractère + le time actuel
            $salt = md5($salt); // On crypte le salt
            // On enregistre le salt dans la BDD par membre (pour ne pas le perdre)
            $mdp_a_crypte = $salt . $mdp;
            $mdp_crypte = md5($mdp_a_crypte);
            $this -> mdp = $mdp_crypte; 
        }
        else{
            return FALSE;
        }
    }

    public function getMdp(){
        return $this -> mdp; 
    }
}

//--------------------------
// EXERCICE : Au regard de cette classe, veuillez créer un membre, affecter des valeurs à pseudo et mdp et les afficher : 

$membre = new Membre;
$membre -> setPseudo('Jawn');
$membre -> setMdp('abracadabra');

echo 'Pseudo : ' . $membre -> getPseudo() . '<br>';
echo 'Mot de passe : ' . $membre -> getMdp() . '<br>';