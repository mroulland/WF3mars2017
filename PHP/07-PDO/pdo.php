<?php
// ********************************
// PDO
// ********************************
// L'extension PHP Data Objects (PDO) définit une interface pour accéder à une base de données depuis PHP. 


// -------------------------------
//  01. Connexion
// -------------------------------
echo '<h1>01. Connexion</h1>';

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//  $pdo est un objet issu de la classe prédéfinie PDO : il représente la connexion à la BDD. 

/* Les arguments passés à PDO : 
        - driver + serveur + nom de la base de données
        - pseudo du SGBD
        - mot de passe du SGBD
        - options : option 1 = générer l'affichage des erreurs
                    option 2 = commandes à exécuter lors de la connexion au serveur qui définit le jeu de caractères des échanges avec la BDD
*/

print_r($pdo);
echo '<pre>'; print_r(get_class_methods($pdo)); echo '</pre>'; // permet d'afficher les méthodes disponibles dans l'objet $pdo


// -------------------------------
//  02. exec() avec INSERT, UPDATE et DELETE
// -------------------------------
echo '<h1>02. exec() avec INSERT, UPDATE et DELETE</h1>';

// $resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES('Jean', 'Tartampion', 'm', 'informatique', '2017-04-25', 300)");

/* 
    exec() est utilisé pour formuler des requêtes ne retournant pas de jeu de résultats : INSERT, UPDATE et DELETE

    Valeur de retour : 
        Succès : un integer correspond au nombre de lignes affectées
        Echec  : false
*/

//echo "Nombre d'enregistrements affectés par l'INSERT : $resultat <br>";
echo 'Dernier id généré : ' . $pdo->lastInsertId();  echo '<br>';

// ----
$resultat = $pdo->exec("UPDATE employes SET salaire = 6000 WHERE id_employes = 350");
echo "Nombre d'enregistrements affectés par l'UPDATE : $resultat <br>";

// -------------------------------
//  03. query() avec SELECT + fetch
// -------------------------------
echo '<h1>03. query() avec SELECT + fetch</h1>';

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
// avce query() : $result est un objet issu de la classe prédéfinie PDOStatement

/*
    Au contraire de l'exec(), query() est utilisé pour la formulation de requêtes retournant un ou plusieurs résultats : SELECT. 

    Valeurs de retour : 
        Succès : objet PDOStatement  
        Echec  : false

    Notez qu'avec query(), on peut aussi utiliser INSERT, DELETE et UPDATE. 
*/

echo '<pre>'; print_r($result); echo '</pre>';
echo '<pre>'; print_r(get_class_methods($result)); echo '</pre>';  // on voit les nouvelles méthodes de la classe PDOStatement

// $result constitue le résultat de la requête sous forme inexploitable directement : il faut donc le transformer par la methode fetch() : 
$employe = $result->fetch(PDO::FETCH_ASSOC);  // la méthode fetch() avec le paramètre PDO::FETCH_ASSOC permet de transformer l'objet $result en un ARRAY associatif exploitable indexé avec le nom des champs de la requête

echo '<pre>'; print_r($employe); echo '</pre>'; 
echo "Bonjour, je suis $employe[prenom] $employe[nom] du service $employe[service] <br>";

// Ou encore faire un fetch selon l'une des méthodes suivantes : 
$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch(PDO::FETCH_NUM);  // pour obtenir un array indexé numériquement
echo '<pre>'; print_r($employe); echo '</pre>'; 
echo $employe[1];  // On accède au prénom par l'indice 1 de l'array $employe 

//-----
$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch();  // pour un mélange de fetch_assoc et fetch_num 
echo '<pre>'; print_r($employe); echo '</pre>'; 

// -----
$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch(PDO::FETCH_OBJ);  // retourne un nouvel objet avec les noms de champs comme propriété (= attribut) public. 
echo '<pre>'; print_r($employe); echo '</pre>';
echo $employe->prenom;  // affiche la valeur de la propriété prénom de l'objet $employe

// Attention : il faut choisir l'un des fetch que vous voulez exécuter sur un jeu de résultats, vous ne pouvez pas faire plusieurs fetch sur le même résultat n'en contenant qu'une seule. En effet, cette méthode déplace un curseur de lecture sur le résultat suivant contenu dans le jeu résultat : ainsi, quand il n'y en a qu'un seul, on sort du jeu. 

// Exercice : afficher le service de l'employée Laura selon deux méthodes différentes de votre choix. 

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'Laura'");
$employe = $result->fetch(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($employe); echo '</pre>';
echo "Bonjour, je suis $employe[prenom] $employe[nom] du service $employe[service] <br>";
echo $employe['service'];


$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'Laura'");
$employe = $result->fetch(PDO::FETCH_NUM);
echo '<pre>'; print_r($employe); echo '</pre>';
echo $employe[4];


/*
    1. Connexion ... new PDO
    2. Requêtes => PDOStatement 
    3. Fetch => array/objet exploitable
    4. echo/print_r
*/

// -------------------------------
//  04. While et fetch_assoc
// -------------------------------
echo '<h1>04. While et fetch_assoc</h1>';

$resultat = $pdo->query("SELECT * FROM employes");

echo 'Nombre d\'employes : ' . $resultat->rowCount() .'<br>'; // Permet de compter le nombre de lignes retournées par la requêtes

while ($contenu = $resultat->fetch(PDO::FETCH_ASSOC)) {  // fetch retourne la ligne suivante du jeu de résultat en array associatif. La boucle while permet de faire avancer le curseur dans le jeu de résultats, et s'arrête quand il est à la fin des résultats. 

    // echo '<pre>'; print_r($contenu); echo '</pre>'; // on voit que $contenu est un array associatif qui contient les données de chaque ligne du jeu de résultats. Le nom des indices correspondent aux noms des champs. 

    echo $contenu['id_employes'] . '<br>';
    echo $contenu['prenom'] . '<br>';
    echo $contenu['nom'] . '<br>';
    echo $contenu['sexe'] . '<br>';
    echo $contenu['service'] . '<br>';
    echo $contenu['date_embauche'] . '<br>';
    echo $contenu['salaire'] . '<br>';
    echo '-----------------<br>';

}

// Quand vous faites une requête qui ne sort qu'un seul résultat : pas de boucle while mais un fetch seul. 
// Quand vous avez plusieurs résultats dans la requête, on fait une boucle while pour parcourir tous les résultats


// -------------------------------
//  05. fetchAll
// -------------------------------
echo '<h1>05. fetchAll</h1>';

$resultat = $pdo->query("SELECT * FROM employes"); 

$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC); // retourne toutes les lignes de résultats dans un tableau multidimensionnel sans faire de boucle : vous avez un array associatif à chaque indice numérique. Marche aussi avec FETCH_NUM 

echo '<pre>'; print_r($donnees); echo '</pre>';

// Pour lire le contenu d'un array multidimensionnel, nous faisons des boucles foreach imbriquées : 
echo '<strong>Double boucle foreach</strong> <br>'; 

foreach ($donnees as $contenu) { // $contenu est un sous array associatif. On parcourt le tableau $donnes et on met les valeurs récupérées dans la variable $contenu (ici, $contenu contiendra chaque Array de $donnees)
    foreach ($contenu as $indice => $valeur){ // on parcourt chaque sous array et on associe (=>) chaque indice à une valeur. 
        echo $indice . ' correspond à ' . $valeur . '<br>';
    }
    echo '----------------<br>';
}




// -------------------------------
//  06. Exercice
// -------------------------------
echo '<h1>06. Exercice</h1>';


// Afficher la liste des bases de données présentes sur votre SGBD dans une liste <ul><li>.
// Pour mémoire, la requête SQL est SHOW DATABASE. 



// Avec FETCHALL

    $result = $pdo->query("SHOW DATABASES");
    $donnees = $result->fetchAll(PDO::FETCH_ASSOC);
    
    echo '<ul>';

        foreach($donnees as $contenu){ // $donnees est un array multi et $contenu contient les sous-array

            foreach($contenu as $indice => $valeur){
                echo '<li>'; echo $valeur; echo '</li>';
            }
        }

    echo '</ul>';


// Avec une boucle WHILE

    $resultat = $pdo->query("SHOW DATABASES");

    echo '<ul>';

        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)){
            // Faire un print_r($donnees) pour récupérer le 'Database'        
            echo '<li>'; echo $donnees['Database']; echo '</li>';
        }

    echo '</ul>';


/*
    1. Connexion ... new PDO
    2. Requêtes => PDOStatement 
    3. Fetch => array/objet exploitable
    4. echo/print_r
*/



// -------------------------------
//  07. Table HTML
// -------------------------------
echo '<h1>07. Table HTML</h1>';

$resultat = $pdo->query("SELECT * FROM employes");

echo '<table border = "1">';
    // Affichage de la ligne d'entête : 
    echo '<tr>';
        for($i=0; $i < $resultat->columnCount(); $i++){
            echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo '</pre>'; // Pour voir ce que retourne la méthode getColumnMeta() : un array avec notamment l'indice 'name' qui contient le nom du champ. 

            $colonne = $resultat->getColumnMeta($i);  // $colonne est un arrray qui contient l'indice name

            echo '<th>' . $colonne['name'] . '</th>'; // L'indice name contient le nom du champs'
        }
    
    echo '</tr>';

    // Affichage des autres lignes : 
    while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>';
            foreach($ligne as $information) {
                // echo '<pre>'; print_r($information); echo '</pre>';
                echo '<td>' . $information . '</td>';
            }
        echo '</tr>';
    }

echo '</table>';


// -------------------------------
//  08. Requêtes préparées : prepare() + bindParam() + execute()
// -------------------------------
echo '<h1>08. Requêtes préparées : prepare() + bindParam() + execute()</h1>';

$nom = 'Sennard';

// Préparation de la requête : 
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom "); // On prépare la requête sans l'exécuter avec une marqueur nominatif écrit :nom 

// On donne une valeur au marqueur :nom
$resultat->bindParam(':nom', $nom, PDO::PARAM_STR);  // Je lie le marqueur :nom à la variable $nom. Si on change le contenu de la variable, la valeur du marqueur changera automatiquement si on fait plusieurs execute. 

// On execute la requête : 
$resultat->execute(); 

$donnees = $resultat->fetch(PDO::FETCH_ASSOC); // $donnees est un array associatif
echo implode($donnees, ' - ');  // implode transforme l'array en string 

/* 
    prepare() renvoie toujours un objet PDOStatment
    execute() renvoie :
            Succès : un objet PDOStatement
            Echec  : false
    
    Les requêtes préparées sont à préconiser si vous exécutez plusieurs fois la même requête (par exemple dans une boucle), et ainsi éviter le cycle complet analyse / interprétation / exécution de la requête. 

    Par ailleurs, les requêtes préparées sont souvent utilisées pour assainir les données en forçant le type des valeurs communiquées aux marqueurs. 
*/


// -------------------------------
//  09. Requêtes préparées : prepare() + bindValue() + execute()
// -------------------------------
echo '<h1>09. Requêtes préparées : prepare() + bindValue() + execute()</h1>';

$nom = 'Thoyer';

// On prépare la requête : 
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom ");

// On lie le marqueur à une valeur : 
$resultat->bindValue(':nom', $nom, PDO::PARAM_STR);  //bindValue reçoit une variable ou un string. Le marqueur pointe uniquement vers la valeur : si celle-ci change, il faudra refaire un bindValue pour prendre en compte cette nouvelle valeur lors d'un prochain execute(). 

// On exécute la requête :
$resultat->execute();

$donnees = $resultat->fetch(PDO::FETCH_ASSOC); // $donnees est un array associatif
echo implode($donnees, ' - '); 

echo '<br>';

// Si on change la valeur de la variable $nom, sans faire un noveau bindValue, le marqueur de la requête pointe toujours vers Thoyer :
$nom = 'Durand';
$resultat->execute();
$donnees=$resultat->fetch(PDO::FETCH_ASSOC); 
echo implode($donnees, ' - '); // en effet, on obtient encore les informations de Thoyer et non pas de Durand.



// -------------------------------
//  10. Exercice
// -------------------------------
echo '<h1>10. Exercice</h1>';

// Après avoir importé la BDD "bibliothèque", affichez dans une liste <ul><li> les livres empruntés par Chloé (il y en a plusieurs ...), en utilisant une requête préparée. 


// 1. Connexion

    $pdo = new PDO('mysql:host=localhost;dbname=bibliotheque', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// 2. requête : 

    $resultat = $pdo->prepare("SELECT l.titre, l.auteur FROM livre l INNER JOIN emprunt e ON l.id_livre = e.id_livre INNER JOIN abonne a ON e.id_abonne = a.id_abonne WHERE a.prenom = :prenom");

    $prenom = 'Chloe';

    $resultat->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $resultat->execute(); // On obtient un objet issu de la classe prédéfinie PDOStatement (= 1 résultat de la requête)

// 3. le fetch :

    echo '<ul>';
        while($livres = $resultat->fetch(PDO::FETCH_ASSOC) ) {
            echo '<li>' ;
            echo $livres['titre'] . ' de ' . $livres['auteur'] ;
            echo '</li>';
        }
    echo '</ul>';


// -------------------------------
//  11. FETCH_CLASS
// -------------------------------
echo '<h1>11. FETCH_CLASS </h1>';

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

class Employes {
    public $id_employes;
    public $nom;
    public $prenom;
    public $sexe;
    public $service;
    public $date_embauche;
    public $salaire;  // On déclare autant de propriétés qu'il y a de champs dans la table employes. L'orthographe des propriétés DOIT être identique à celle des champs. 
}

$result = $pdo->query("SELECT * FROM employes");

$donnees = $result->fetchAll (PDO::FETCH_CLASS, 'Employes'); // on obtient un array multidimensionnel indicé numériquement, qui contient à chaque indice un objet issu de la classe Employes

echo '<pre>'; print_r($donnees); echo '</pre>';

// //  On affiche le contenu de $donnees avec une boucle foreach : 
// foreach ($donnees as $employe){
//     echo $employe;
// }


// -------------------------------
//  12. Points complémentaires
// -------------------------------
echo '<h1>12. Points complémentaires</h1>';

// ----------
echo '<strong>Le marqueur "?"</strong><br>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = ? AND prenom = ?"); // On prépare dans un premier temps la requête sans sa partie variable, que l'on représente avec des marqueurs sous forme de "?"

$resultat->execute(array('durand', 'damien'));  // durant va remplacer le premier ? et damien le second. 
$donnees = $resultat->fetch(PDO::FETCH_ASSOC); // Pas de boucle while car on sait qu'il n'y a qu'un seul résultat dans cette requête

echo implode($donnees, ' - '); // notez que nous faisons implode ici pour aller plus viteet éviter de faire un affichage dans un boucle ... 


// ------
echo '<br><strong>On peut faire un execute() sans bindParam()</strong> <br>';
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom"); 
$resultat->execute(array('nom' => 'durand', 'prenom' => 'damien'));  // notez que nous ne sommes pas obligés de mettre les ":" devant les marqueurs 

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo implode($donnees, ' - ');

// ------
echo '<br><strong>Afficher une erreur de requête SQL</strong><br>';
$resultat = $pdo->prepare("SELECT * FROM azerty WHERE nom = 'durand'");
$resultat->execute();

echo '<pre>'; print_r($resultat->errorInfo()); echo '</pre>'; // errorInfo est une méthode qui appartient à la classe PDOStatement et qui fournit des infos sur l'erreur SQL éventuellement produite. On trouve le message de l'erreur à l'indice [2] de l'array retourné par cette méthode. 


// -------------------------------
//  13. Mysqli
// -------------------------------
echo '<h1>13. Mysqli</h1>';

// Il existe une autre manière de se connecter à une base de données et d'effectuer des requêtes sur celle-ci : l'extension Mysqli. 

// Connexion à la BDD : 
$mysqli = new Mysqli('localhost', 'root', '', 'entreprise'); 

// Un exemple de requête : 
$requete = $mysqli->query("SELECT * FROM employes");

// Notez que les objets $mysqli (issu de la classe prédéfinie Mysqli) et $requete (issu de la classe Mysqli_result) ont des propriétés et des méthodes différentes de PDO. Nous ne pouvons donc pas les mélanger. 


// **********************************************************************************

