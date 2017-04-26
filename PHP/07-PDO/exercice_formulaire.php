<?php
// EXERCICE :
// Principe : créer un formulaire qui permet d'enregistrer un nouvel employé dans la base entreprise.

/* Les étapes : 
    - Création du formulaire HTML 
    - Connexion à la BDD
    - Lorsque le formulaire est posté, insertion des informations du formulaire en BDD (en requête préparée). 
    - Afficher à la fin un message "L'employé a bien été ajouté". 
*/


// Création du formulaire HTML


// Connexion à la base de données 

     $pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// Insertion des informations du formulaire en requête préparée

if(!empty($_POST)){
    print_r($_POST);


}

// INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES(   )

?>



<form method="post" action="">

    <input type="text" name="prenom" placeholder="prenom">
    <input type="text" name="nom" placeholder="nom">
    <input type="radio" name="masculin" value="m"> masculin
    <input type="radio" name="feminin" value="f"> féminin
    <select name="service" id="service">
        <option value="informatique">informatique</option>
        <option value="commercial">commercial</option>
        <option value="production">production</option>
        <option value="direction">direction</option>
        <option value="secretariat">secretariat</option>
        <option value="juridique">juridique</option>
        <option value="comptabilite">comptabilite</option>
    </select>
    <input type="text" name="date_embauche" placeholder="Date au format AAAA-MM-JJ">
    <input type="number" name="salaire" placeholder="Salaire">

    <input type="submit" value="Envoyer">

</form>

