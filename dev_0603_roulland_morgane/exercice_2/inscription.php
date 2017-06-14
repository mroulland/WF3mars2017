<?php

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=exercice2;charset=utf8', 'root', '');

$errors = '';
$message = '';

// Si le formulaire a été posté 
if(!empty($_POST)){

   // Contrôle des champs du formulaire 

   if(strlen($_POST['inscription']['nom']) < 0){
     $errors .= '<div>Le nom est obligatoire</div>';
   }

   if(strlen($_POST['inscription']['prenom']) < 0){
     $errors .= '<div>Le prénom est obligatoire</div>';
   }

   if(!filter_var($_POST['inscription']['email'], FILTER_VALIDATE_EMAIL)){
     $errors .= '<div>L\'email n\'est pas valide</div>';
   }

   if(strlen($_POST['inscription']['password']) < 0){
     $errors .= '<div>Le mot de passe est obligatoire</div>';
   }

   if($_POST['inscription']['type'] != 'eleve' && $_POST['inscription']['type'] != 'formateur'){
        $contenu .= '<div class="bg-danger">Le type est incorrecte </div>';

    }
  
   // Si aucune erreur dans le formulaire, on vérifie que l'adresse mail est unique : 

   if(empty($errors)){
      // $email = $_POST['inscription']['email'];
      // $user = $pdo->prepare("SELECT id_user FROM users WHERE email = $email");
      // $user->execute();

      // $resultat = $user->fetchAll();


      // if($resultat->rowCount() < 0){ // On a trouvé un identifiant comportant cet email dans la bdd 
      //     $message .= '<div class="bg-danger">L\'email est indisponible. Veuillez en choisir un autre</div>';
      // } else{ 
        
        // Si l'email n'existe pas, on procède au cryptage
          $_POST['inscription']['password'] = md5($_POST['inscription']['password']);

          // Puis, on enregistre le membre en BDD

          $insertUser = $pdo->prepare('INSERT INTO users(lastname, firstname, email, password, type) VALUES(:lastname, :firstname, :email, :password, :type)');

          // Association des marqueurs aux valeurs correspondantes
          $insertUser->bindValue(':lastname', $_POST['inscription']['nom']);
          $insertUser->bindValue(':firstname', $_POST['inscription']['prenom']);
          $insertUser->bindValue(':email', $_POST['inscription']['email']);
          $insertUser->bindValue(':password', $_POST['inscription']['password']);
          $insertUser->bindValue(':type', $_POST['inscription']['type']);


          // Exécuter la requête
          $resultat = $insertUser->execute();
    
   }
}





?>

<!-- AFFICHAGE -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Inscription</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <style>
    .myform-container.myform {
      max-width: 600px;
      padding: 40px 40px;
    }

    .btn {
      font-weight: 700;
      height: 36px;
      -moz-user-select: none;
      -webkit-user-select: none;
      user-select: none;
      cursor: default;
    }

    .myform {
      background-color: #F7F7F7;
      padding: 20px 25px 30px;
      margin: 0 auto 25px;
      margin-top: 50px;
      -moz-border-radius: 2px;
      -webkit-border-radius: 2px;
      border-radius: 2px;
      -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }
  </style>
</head>

<body>

  <?php echo $message; ?>
  <?php echo $errors; ?>

  <div class="myform myform-container">
    <form class="form-horizontal" method="POST">

      <div class="form-group">
        <div class="col-sm-12">
          <input type="text" class="form-control" name="inscription[nom]" placeholder="Nom" autofocus>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-12">
          <input type="text" class="form-control" name="inscription[prenom]" placeholder="Prénom">
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-12">
          <input type="email" name="inscription[email]" class="form-control" placeholder="Email">
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-12">
          <input type="password" name="inscription[password]" class="form-control" placeholder="Mot de passe">
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-12">
          <div class="radio">
            <label>
              <input type="radio" name="inscription[type]" value="eleve" checked> Elève
            </label>
          </div>
          <div class="radio">
            <label>
              <input type="radio" name="inscription[type]" value="formateur"> Formateur
            </label>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-12">
          <button type="submit" name="submit" class="btn btn-default">S'inscrire</button>
        </div>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>
</html>