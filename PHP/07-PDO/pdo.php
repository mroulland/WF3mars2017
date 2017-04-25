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