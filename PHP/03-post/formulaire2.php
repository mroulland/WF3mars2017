<link rel="stylesheet" href="css/style.css">

<?php
// Exercice : créer le formulaire indiqué au tableau, récupérer les données saisies et les afficher dans la même page. 

// print_r($_POST);
echo '<h1>Formulaire</h1> <article>';

if(!empty($_POST)){
    echo 'Ville : ' . $_POST['ville'] . '<br>';
    echo 'Code Postal : ' . $_POST['codePostal'] . '<br>'; // attention : les name sont sensibles à la casse
    echo 'Adresse : ' . $_POST['adresse'] . '<br>';

}

echo '</article>'

?>


<form method="post" action="#">
    <label for="ville">Ville</label>
    <input type="text" id="ville" name="ville">

    <label for="codePostal">Code Postal</label>
    <input type="number" id="codePostal" name="codePostal">

    <label for="adresse">Adresse</label>
    <textarea name="adresse" id="adresse"></textarea>

    <input type="submit" name="validation" value="envoyer">
</form>

