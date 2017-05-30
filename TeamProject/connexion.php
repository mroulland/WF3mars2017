<?php
require_once('inc/init.inc.php');

// ---------------------------- TRAITEMENT ---------------------------------
// Deconnexion demandée par l'internaute:
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
    // si l'internaute demande la déconnexion, on détruit la session:
    session_destroy();
}

// Internaute déjà connecté : 
if(connected()){ // si l'internaute est déjà connecté, il n'a rien a faire ici, on le redirige donc vers son profil
    header('location:profil.php');
}

// Traitement du formulaire de connexion, et remplissage de la session : 
if(!empty($_POST)){
    
    // contrôle du formulaire
    if(empty($_POST['pseudo'])){
        $contenu .= '<div class="bg-danger">Le pseudo est obligatoire</div>';
    }

     if(empty($_POST['mdp'])){
        $contenu .= '<div class="bg-danger">Le mot de passe est obligatoire</div>';
     }

     // Si le formulaire est correct, on contrôle les identifiants : 
     if(empty($contenu)){
         $mdp = md5($_POST['mdp']); // on crypte le mdp pour le comparer avec celui de la base

         $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp", array(':pseudo' => $_POST['pseudo'], ':mdp' => $mdp)); // le $_POST ne s'applique pas sur l'indice mdp car il est crypté

         if($resultat->rowCount() != 0) { // si il y a un enregistrement dans le $resultat, c'est que pseudo et mdp correspondent
            $membre = $resultat->fetch(PDO::FETCH_ASSOC); // pas de while car il y a unicité du pseudo

            $_SESSION['membre'] = $membre; // nous remplissons la session avec les éléments provenant de la BDD. Cette session permet de conserver les infos du membre dans l'ensemble du site

            header('location:profil.php'); // le membre étant connecté, on l'envoie vers son profil
            exit();
         }else{
             //si les identifiants ne correspondent pas, on affiche un message d'erreur : 
             $contenu .= '<div class="bg-danger">Erreur sur les identifiants</div>';
         }

     }//fin du if(empty($contenu))

}//fin du if(!empty($_POST))


// ---------------------------- AFFICHAGE ----------------------------------
require_once('inc/haut.inc.php');
echo $contenu;
?>
<h3>Veuillez renseigner vos identifiants pour vous connecter</h3>

<form method="post" action="">
    
    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" value=""><br><br>

    <label for="mdp">Mot de passe</label><br>
    <input type="password" id="mdp" name="mdp" value=""><br><br>

    <input type="submit" name="connexion" value="se connecter" class="btn">

<?php
require_once('inc/bas.inc.php');
