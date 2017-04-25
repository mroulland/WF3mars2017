<?php
//exercice : 
/* 
    - Faire 4 liens HTML avec le nom des fruits.
    - Quand on clique sur un lien, on affiche le prix pour 1000g de ce fruit, dans cette page lien_fruits.php
*/

// print_r($_GET); 

include('fonctions.inc.php');

if(!empty($_GET['fruit'])){
    echo calcul($_GET['fruit'], 1000);
} else{
    echo 'Aucun fruit sélectionné !';
}

?>

<link rel="stylesheet" href="style.css">
<nav>
    <a href="liens_fruits.php?fruit=cerises">Cerises</a>
    <a href="liens_fruits.php?fruit=bananes">Bananes</a>
    <a href="liens_fruits.php?fruit=pommes">Pommes</a>
    <a href="liens_fruits.php?fruit=peches">Pêches</a>
</nav>
<br>

<?php