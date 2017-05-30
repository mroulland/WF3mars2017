<?php 
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$tab = array();

$liste_employes = $pdo->query("SELECT * FROM employes");

$tab['resultat'] = '<table class="table table-bordered">';
$tab['resultat'] .= '<tr>';

// Il vaut mieux mettre columnCount à l'extérieur de la boucle car sinon, la boucle exécute la requête à chaque fois. C'est donc plus léger de stocker l'information dans une variable. 
$nb_col = $liste_employes->columnCount(); 

// Boucle pour afficher les entêtes du tableau
for($i = 0; $i < $nb_col; $i++){
    $colonne = $liste_employes->getColumnMeta($i); 
    $tab['resultat'] .= '<th>' . $colonne['name'] . '</th>';
}
$tab['resultat'] .= '</tr>';

while($ligne = $liste_employes->fetch(PDO::FETCH_ASSOC)){
    $tab['resultat'] .= '<tr>';
    foreach($ligne as $valeur){
        $tab['resultat'] .= '<td>' . $valeur . '</td>';
    }
    $tab['resultat'] .= '</tr>';
}
$tab['resultat'] .= '</table>';

// echo $tab['resultat'];
echo json_encode($tab);