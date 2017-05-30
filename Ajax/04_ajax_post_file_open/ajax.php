<?php

$email = 1;
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
// Création ou ouverture d'un fichier via la fonction fopen
// En mode php on a crée le fichier s'il n'existe pas sinon il ne fait que l'ouvrir. 

$f = fopen("email.txt", "a"); // la fonction fopen prend deux paramètres : le chemin du fichier, le mode.
// fonction fwrite (f pour file) sert à écrire dans un fichier txt

fwrite($f, $email . "\n"); // \n permet le retour à la ligne dans un fichier. Il doit être entre "" sinon il ne sera pas interpreté. 

$tab = array();
$tab['resultat'] = '<h2>Confirmation de l\'inscription </h2>';

$liste = file("email.txt"); // La fonction file() place chaque ligne du fichier précisé en argument dans un tableau array.

$tab['resultat'] .= '<p>Voici la liste de tous les inscrits</p>';

$tab['resultat'] .= '<ul>';
foreach($liste as $valeur){
    $tab['resultat'] .= '<li>' . $valeur . '</li>';
}
$tab['resultat'] .= '</ul>';

echo json_encode($tab);