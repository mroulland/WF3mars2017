<?php

// Exercice : réalisez un formulaire "pseudo" et "email" dans formulaire 3.php en récupérant et affichant les informations dans formulaire4.php. 

// De plus, une fois le formulaire soumis, vous vérifiez que le pseudo n'est pas vide. Si tel est le cas, affichez un message d'erreur à l'internaute. (dans formulaire4.php)

?>
<link rel="stylesheet" href="css/style.css">

<h1>Formulaire 3</h1>

<form action="formulaire4.php" method="post"> 
    <label for="pseudo" name="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo">

    <label for="email" name="email">@Email</label>
    <input type="email" id="email" name="email"> 

    <input type="submit" value="Envoyer">

</form>