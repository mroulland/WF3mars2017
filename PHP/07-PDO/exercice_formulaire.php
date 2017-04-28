<?php
// EXERCICE :
// Principe : créer un formulaire qui permet d'enregistrer un nouvel employé dans la base entreprise.

/* Les étapes : 
    - Création du formulaire HTML 
    - Connexion à la BDD
    - Lorsque le formulaire est posté, insertion des informations du formulaire en BDD (en requête préparée). 
    - Afficher à la fin un message "L'employé a bien été ajouté". 
*/

$message = ''; // variable d'affichage des messages d'erreur de validation du formulaire 

// Création du formulaire HTML
    // voir plus bas --

// Connexion à la base de données 

     $pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Insertion des informations du formulaire en requête préparée

if(!empty($_POST)){  // Si le formulaire est posté, il y a donc des indices dans $_POST, il n'est pas vide (pas forcément des valeurs)

    // Contrôle du formulaire :
    if (strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 20) $message .= '<div>Le prenom doit comporter au moins 3 caractères </div>';   // strlen indique le nombre de caractères

    if (strlen($_POST['nom']) < 3 || strlen($_POST['nom']) > 20) $message .= '<div>Le nom doit comporter au moins 3 caractères </div>';

    if ($_POST['sexe'] != 'm' && $_POST['sexe'] != 'f') $message .= '<div>Le sexe n\'est pas correct</div>';
    

    if ($_POST['service'] == 'null') $message .= '<div>Le service doit être sélectionné </div>';
    if (!is_numeric($_POST['salaire']) || $_POST['salaire'] <= 0) $message .= '<div>Le salaire doit être supérieur à 0</div>'; // is_numeric() teste si c'est un nombre

    $tab_date = explode('-', $_POST['date_embauche']);  // met le jour, le mois et l'année dans un array pour pouvoir les passer à la fonction checkdate ($mois, $jour, $annee)
    if(!(isset($tab_date[0]) && isset($tab_date[1]) && isset($tab_date[2]) && checkdate($tab_date[1], $tab_date[2], $tab_date[0]) ) );

    if (empty($message)){ // Si les messages sont vides c'est qu'il n'y a pas d'erreur. 

        $resultat = $pdo->prepare("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES (:prenom, :nom, :sexe, :service, :date_embauche, :salaire)");

        $resultat->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $resultat->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
        $resultat->bindParam(':sexe', $_POST['sexe'], PDO::PARAM_STR);
        $resultat->bindParam(':service', $_POST['service'], PDO::PARAM_STR);
        $resultat->bindParam(':date_embauche', $_POST['date_embauche'], PDO::PARAM_STR);
        $resultat->bindParam(':salaire', $_POST['salaire'], PDO::PARAM_INT);

        $req = $resultat->execute(); 

        // Afficher le message "L'employé a été ajouté" : 
            if($req) {  // execute() ci-dessus renvoie soit un objet PDOStatement (qui a une valeur implicite TRUE) si la requête a fonctionnée, sinon il renvoie un booléen false. Si $req contient un objet, il vaut true implicitement : on entre donc dans la condition. 
                echo 'L\'employé a bien été ajouté'; 

            } else {
                echo 'Une erreur est survenue lors de l\'enregistrement'; 
            }
    }
}

// INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES(   )

?>

<style></style>

<form method="post" action="">

<?php echo $message; ?>

    <input type="text" name="prenom" placeholder="prenom"><br><br>
    <input type="text" name="nom" placeholder="nom"><br><br>
    <input type="radio" name="sexe" id="homme" value="m" checked> <label for="homme">Homme</label>
    <input type="radio" name="sexe" id="femme" value="f"> <label for="femme">Femme</label> <br><br>
    <select name="service" id="service">
        <option value="null">-- Choisissez --</option>
        <option value="informatique">Informatique</option>
        <option value="commercial">Commercial</option>
        <option value="production">Production</option>
        <option value="direction">Direction</option>
        <option value="secretariat">Secretariat</option>
        <option value="juridique">Juridique</option>
        <option value="comptabilite">Comptabilite</option>
    </select><br><br>
    <input type="text" name="date_embauche" placeholder="Date au format AAAA-MM-JJ"><br><br>
    <input type="number" name="salaire" placeholder="Salaire"><br><br>

    <input type="submit" value="Envoyer">

</form>

