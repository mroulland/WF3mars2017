<?php 
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$id_employes = isset($_POST['personne']) ? $_POST['personne'] : '';

$employes = $pdo->query("SELECT * FROM employes WHERE id_employes = $id_employes");

$informations_employes = $employes->fetch(PDO::FETCH_ASSOC);

$tab = array();
$tab['resultat'] = "<table border='1'><tr>";
$tab['resultat'] .= '<th>' . implode('</th><th>', array_keys($informations_employes)) . ' </th></tr>'; 
//Les fonctions implodes et explodes permettent de transformer un array en chaine de caractères selon les séparateurs indiqué, ou inversement. Ici, on demande à implode de transformer en string chaque données du tableau$informations_employes et array_keys permet de ne sélectionner que les indices du tableau pour créer un nouveau tab où les indices sont désormais des valeurs)

$tab['resultat'] .= '<tr>';

foreach($informations_employes as $valeur){
    $tab['resultat'] .= '<td>' . $valeur . '</td>';
}

$tab['resultat'] .= '</tr></table>';


echo json_encode($tab);

