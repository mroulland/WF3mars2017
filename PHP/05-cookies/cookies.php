<?php 
// *****************************************
//  LES COOKIES
// *****************************************

/* 
    Un cookie est un petit fichier (4ko max) déposé par le serveur du site sur le poste de l'internaute, et qui peut contenir des informations sous forme de texte. Les cookies sont automatiquement revoyés au serveur web par le navigateur lorsque l'internaute navigue dans les pages concernées par les cookies. 

    PHP peut très facilement récupérer les données contenues dans un cookie : ses informations sont stockées dans la superglobable $_COOKIE. 

    Précaution à prendre avec les cookies : un cookie étant sauvegardé sur le poste de l'internaute, il peut être volé ou détourné. On n'y stocke donc pas de données sensibles (mot de passe, numéro de CB... ). 
*/

// Application pratique : nous allons stocker la langue choisie par l'internaute dans un cookie. 

// 1 - Affectation de la langue à la variable $langue : 
if( isset($_GET['langue'])){   // Si une langue est passée dans l'url c'est que nous avons cliqué sur un lien
    $langue = $_GET['langue'];
} elseif (isset($_COOKIE['langue'])) {  // $_COOKIE est une superglobale dont l'indice correpond au nom du cookie. On entre dans le elseif i un cookie appelé "langue" a été envoyé par le client.
    $langue = $_COOKIE['langue'];
} else {
    $langue = 'fr'; // Par défaut, si aucun choix n'est fait et que n'existe pas le cookie, alors on affecte 'fr'
}

// 2 - Envoi du cookie avec la langue : 
$un_an = 365 * 24 * 60 * 60;  // Un an exprimé en secondes

setCookie('langue', $langue, time() + $un_an);  // setCookie('nom', 'valeur', 'date expiration en timestamp') permet de créer et d'envoyer le cookie vers le client



// 3 - Affichage de la langue : 
echo 'Votre langue : ';
switch($langue) {
    case 'fr' : echo 'français'; break;
    case 'es' : echo 'espagnol'; break;
    case 'en' : echo 'anglais'; break;
    case 'it' : echo 'italien'; break;
}





?>

<h1>Votre langue :</h1>
<ul>
    <li><a href="?langue=fr">Français</a></li>    
    <li><a href="?langue=es">Espagnol</a></li>
    <li><a href="?langue=en">Anglais</a></li>
    <li><a href="?langue=it">Italien</a></li>

</ul>