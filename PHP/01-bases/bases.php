<style>h2{font-size:15px; color: red;}</style>


<?php 

//---------------------------------------------
echo '<h2> Les balises PHP </h2>';
//---------------------------------------------
?>

<?php
// Pour ouvrir un passage en PHP, on utilise la balise précédente
// Pour fermer un passage en PHP, on utilise la balise suivante 
?>

<strong>Bonjour</strong> <!-- en dehors des balises d'ouverture et de fermeture du PHP, nous pouvons écrire du HTML -->

<?php
// --------------------------------------------
echo '<h2> Ecriture et affichage </h2>';
// --------------------------------------------
echo 'Bonjour'; // echo est une instruction qui nous permet d'effectuer un affichage. Notez que les instructions se terminent par un ";"
echo '<br>'; // On peut mettre des balises HTML dans un echos, elles sont interprêtées comme telles.

print 'Nous sommes jeudi'; // print est une autre instruction d'affichage.

// Pour infos, il existe d'autres instructions d'affichage (cf plus loin : 
// print_r();  
// var_dump();



//---------------------------------------------
echo '<h2> Variable : types / déclaration / affectation </h2>';
//---------------------------------------------
// Définition : une variable est un espace mémoire nommé qui permet de conserver une valeur.
// En PHP, on déclare une variable avec le signe $

$a = 127;    // je déclare la variable a et je lui affecte la valeur 127.
// Le type de la variable a est integer (entier)

$b = 1.5;    // un type double pour nombre à virgule.

$a = 'Une chaîne de caractères';  // type string pour une chaîne de caractères
$b = '127';  // Il s'agit aussi d'un string car il y a des quotes

$a = true;   // Type boolean qui prend que deux valeurs possibles : true ou false.


//---------------------------------------------
echo '<h2> Concaténation </h2>';
//---------------------------------------------
$x = 'bonjour ';
$y = 'tout le monde';
echo $x . $y . '<br>';  // point de concaténation que l'on peut traduire par 'suivi de'

echo "$x $y <br>";      // on obtient le même résultat sans concaténation (cf chapitre d'après pour l'explication de l'évaluation des variables dans des guillemets)



// ----------------------
// Concaténation lors de l'affectation : 
$prenom1 = 'Bruno';   // déclaration de la variable $prenom1
$prenom1 = 'Claire';  // Ici, la valeur "Claire" écrase la valeur précédente "Bruno" qui était contenue dans la variable
echo $prenom1 . '<br>'; // Affiche Claire


$prenom2 = 'Bruno';
$prenom2 .= 'Claire';  // on affecte la valeur 'Claire' à la variable $prenom2 en l'ajoutant à la valeur précédemment contenue dans la variable grâce à l'opérateur .=
echo $prenom2 . '<br>'; // Affiche BrunoClaire


//---------------------------------------------
echo '<h2> Guillemets et quotes </h2>';
//---------------------------------------------
$message = "aujourd'hui"; // ou bien : 
$message = 'aujourd\'hui'; // dans les quotes on échappe les apostrophes avec l'anti-slash (alt gr + 8)

$txt = 'Bonjour';
echo "$txt tout le monde <br>";  // Les variables sont évaluées quand elles sont présentes dans des guillemets, c'est leur contenu qui est affiché
echo '$txt tout le monde <br>';  //  dans les quotes simples, on affiche littéralement le nom des variables : elles ne sont pas évaluées.



//---------------------------------------------
echo '<h2> Constantes </h2>';
//---------------------------------------------
// Une constante permet de conserver une valeur qui ne peut pas (ou ne doit pas être modifiée) durant la durée du script. Très utile pour garder de manière certaine la connexion à une BDD ou le chemin du site par exemple.

define("CAPITALE", "Paris"); // Par convention, on écrit toujours le nom des constantes en MAJUSCULE. Define permet de déclarer une constante dont on indique d'abord le nom puis la valeur. 
echo CAPITALE . '<br>'; // Affiche Paris

// Constantes magiques : 
echo __FILE__ . '<br>';  // Affiche le chemin complet du fichier dans lequel on est ..
echo __LINE__ . '<br>';  // Affiche la ligne à laquelle on est .. 


//---------------------------------------------
echo '<h2> Opérateurs arithématiques </h2>';
//---------------------------------------------
$a = 10;
$b = 2;

echo $a + $b . '<br>';  // Affiche 12
echo $a - $b . '<br>';  // Affiche 8
echo $a * $b . '<br>';  // Affiche 20
echo $a / $b . '<br>';  // Affiche 5
echo $a % $b . '<br>';  // Affiche 0

//---------
// Opérations et affectation combinées :
$a += $b;  // $a vaut 12 car équivaut à $a = $a + $b soit 10 + 2
$a -= $b;  // $a vaut 10 car équivaut à $a = $a - $b soit 12 - 2 
$a *= $b;  // $a vaut 20
$a /= $b;  // $a vaut 10
$a %= $b;  // $a vaut 0

//---------
// Incrémenter et décrémenter :
$i = 0;
$i++;  // incrémentation de $i de +1 (vaut 1)
$i--;  // décrémentation de $i de -1 (vaut 0)

$k = ++$i;  // la variable est incrémentée de 1, puis elle est affectée à k
echo $i . '<br>';  // 1
echo $k . '<br>';  // 1

$k = $i++; // La variable est d'abord affectée à k avant d'être incrémentée de 1
echo $i . '<br>';  // 2
echo $k . '<br>';  // 1


//---------------------------------------------
echo '<h2> Structures conditionnelles et opérateurs de comparaison </h2>';
//---------------------------------------------
$a = 10; $b = 5; $c = 2;

if ($a > $b) {  // Si la condition renvoie true, on exécute les accolades qui suivent :
    echo '$a est bien supérieur à $b  <br>';
} else{  // Sinon (si la condition renvoie false, on exécute le else : 
    echo 'Non, c\'est $b qui est supérieur à $a <br>';
}

//-----------
if ($a > $b && $b > $c) {  
    echo 'Les deux conditions sont vraies  <br>';
} 

//-----------
if ($a == 9  ||  $b > $c) {  // L'opérateur de comparaison est == et l'opérateur ou s'écrit || 
    echo 'OK pour une des deux conditions <br>';
} else{ 
    echo 'Les deux conditions sont fausses <br>';
}

//------------
if ($a == 8) {
    echo 'Réponse 1 <br>';
} elseif ($a != 10) { // Sinon si $a différent de 10, on éxecute les accolades qui suivent : 
    echo 'Réponse 2 <br>';
} else { // Sinon, si les conditions précédentes sont fausses, on exécute les accolades qui suivent : 
    echo 'Réponse 3 <br>'; // On entre ici dans le else 
}

// ----------
if ($a == 10 XOR $b == 6) {
    echo 'ok pour la condition exclusive <br>';  // Si les deux conditions sont vraies ou les deux conditions sont fausses en même temps, nous n'entrons pas dans les accolades'
}
// Pour que la condition s'execute, il faut que l'une soit ou alors que l'autre soit vraie, mais pas les deux en même temps. 


//--------
// Conditions ternaires (forme contractée de la condition) :
echo ($a == 10) ? '$a est égal à 10 <br>' : '$a est différent de 10 <br>';  
// Le "?" remplace le if et le ":" remplace le else. Si a vaut 10, on fait une echo du premier string, sinon du second. 


// ----------
//  Différence entre == et === :
$vara = 1;  // integer
$varb = '1';  // string

if ($vara == $varb)  {
    echo 'il y a égalité en valeur ET en type entre les deux variables <br>';
}
// Avec la présence du triple =, la comparaison ne fonctionne pas car les variables ne sont pas du même type : on compare un integer avec un string.

// Avec le double égal on ne compare que la valeur : la comparaison est donc juste. 

/* 

=       signe d'affectation
==      comparaison en valeur
===     comparaison en valeur et en type

*/

//----------
// empty() et isset() : 
// empty() : teste si c'est vide (c'est à dire 0, '', NULL, false ou non défini)
// isset() : teste si c'est défini et a une valeur non NULL 

$var1 = 0;
$var2 = '';  // Chaîne vide sans espace

if (empty ($var1)) echo 'on a 0, vide ou non définie <br>';
if (isset ($var2)) echo 'var2 existe bien <br>';

// Différence entre empty et isset : si on met les lignes 203 et 204 en commentaires (pour les neutraliser), empty reste vrai car $var1 n'est pas définie, alors que isset est faux car $var 2 n'est pas définie.

// empty sera utilisé pour vérifier , par exemple; que les champs d'un formulaire sont remplis. Isset permettra de vérifier l'existence d'un indice dans un array avant de l'utiliser. 





// ---------------------------
// Entrer une valeur dans une variable sous condition (PHP7) : 
$var1 = isset($maVar) ? $maVar : 'valeur par défaut';  // dans cette ternaire, on affecte la valeur de $maVar à var1 si elle existe. Celle-ci n'existant pas, on lui affecte 'valeur par défaut'
echo $var1 . '<br>';   // Affiche 'valeur par défaut' 

// En version PHP7 :
$var2 = $maVar ?? 'valeur par défaut';   // On fait exactement la même chose mais en plus court : le "??" signifie "soit l'un soit l'autre", "prend la première valeur qui existe"
echo $var2 . '<br>';

$var3 = $_GET['pays'] ?? $_GET['ville'] ?? 'pas d\'info'; // Soit on prend le pays s'il existe, sinon on prend la ville si elle existe, sinon on prend 'pas d'info' par défaut. 
echo $var3 . '<br>';


// ---------------------------------
echo '<h2> Condition switch </h2>';
//  --------------------------------
// Dans le switch ci-dessous, les "cases" représentent les cas différents dans lesquels on peut potentiellement tomber.
$couleur = 'jaune';

switch($couleur) {
    case 'bleu' : echo 'Vous aimez le bleu'; break;
    case 'rouge' : echo 'Vous aimez le rouge'; break;
    case 'vert' : echo 'Vous aimez le vert'; break;
    default : echo 'Vous n\'aimez ni le bleu, ni le rouge, ni le vert. <br>';
}

// Le switch compare la valeur de la variable entre parenthèses à chaque case. Lorsqu'une valeur correspond, on exécute l'instruction en regard du case, puis le break qui indique qu'il faut sortir de la condition. 
// Le default correspond à un else : on l'exécute par défaut quand aucun case ne correspond. 

// Exercice : écrivez la condition ci-dessus avec des if...

$couleur = 'vert';

if( $couleur == 'bleu' ){
    echo 'Vous aimez le bleu';

} elseif ( $couleur == 'rouge' ){
    echo 'Vous aimez le rouge';

} elseif ( $couleur == 'vert' ){
    echo 'Vous aimez le vert';

} else{
    echo 'Vous n\'aimez ni le bleu, ni le rouge, ni le vert. <br>';
}


// ---------------------------------
echo '<h2> Fonctions prédéfinies </h2>';
//  --------------------------------
//  Une fonction prédéfinie permet de réaliser un traitement spécifique qui est prévu dans le langage. 

// -----------
echo '<h2>Traitement des chaînes de caractères (strlen, strpos, substr)</h2>';
$email1 = 'prenom@site.fr';

echo strpos($email1, '@') . '<br>';   // strpos() indique la position 6 du caractère "@" dans la chaîne $email1 
echo strpos('Bonjour', '@');
var_dump(strpos('Bonjour', '@')) . '<br>';
// Quand j'utilise une fonction prédéfinie, il faut se demander quels sont les arguments à lui fournir pour qu'elle s'exécute correctement, et ce qu'elle peut retourner comme résultat. 
// Dans l'exemple de strpos() : succès => elle retourne un "integer", echec => elle retourne un "booléen = false".

//  ---------
$phrase = 'Mettez une phrase à cet endroit'; 
echo '<br>' . strlen($phrase) . '<br>'; // Affiche la longueur du string : succes => integer, échec => false

// --------------
$texte = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt aut facere ab qui, voluptas recusandae repudiandae dolorem sapiente rem a fugiat modi beatae accusantium quo maxime animi ratione doloremque, vero.';
echo substr($texte, 0, 20) . '... <a href="#"> Lire la suite ... </a>';  // On découpe une partie du texte et on lui concatène un lien. Succès => string, echec => false.

// --------------
echo str_replace('site', 'gmail', $email1);  // remplace 'site' par 'gmail' dans le string contenu dans $email1

// -------------
$message ='            Hello World         ';
echo strtolower($message) . '<br>';   // passe le string en minuscules
echo strtoupper($message) . '<br>';   // passe le string en majuscules

echo strlen($message) . '<br>';
echo strlen(trim($message)) . '<br>';  // trim() permet de supprimer les espaces au début et à la fin d'un string


// ---------------------------------
echo '<h2> Le manuel PHP en ligne </h2>';
//  --------------------------------
// Le manuel PHP en ligne : 
// http://php.net/manual/fr 


// ---------------------------------
echo '<h2> Gestion des dates </h2>';
//  --------------------------------
echo date('d/m/Y H:i:s' ) . '<br>'; // affiche la date et heure de l'instant selon le format indiqué : d = day, m = month, Y = year sur 4 chiffres, y = year sur 2 chiffres, H = heures sur 24h, i = minutes, s = secondes. On peut choisir les séparateurs

echo time() . '<br>';  // retourne le timestamp actuel = nombre de secondes écoulées depuis le 01/01/1970 à 00:00:00 (création théorique de UNIX). 

// La fonction prédéfinie strtotome() : 
$dateJour = strtotime('10-01-2016');  // retourne le timestamp de la date indiquée
echo $dateJour . '<br>';

// La fonction strftime() : 
$dateFormat = strftime('%Y-%m-%d', $dateJour); // transforme le timestamp donné en date selon le format indiqué, ici YYYY-MM-DD
echo $dateFormat . '<br>';  // affiche 2016-01-10

// Exemple de conversion de format de date : 
// Transformer 23-05-2015 en 2015-05-23 
echo strftime ('%Y-%m-%d', strtotime('23-05-2015'));

echo '<br>';
// Transformer 2015-05-23 en 23-05-2015
echo strftime ('%d-%m-%Y', strtotime('2015-05-23'));

// Cette méthode de transformation est limitée dans le temps (2038) .... On peut donc utiliser une autre méthode avec la cmasse DateTime :
$date = new DateTime('11-04-2017'); 
echo $date->format('Y-m-d');
// DateTime est une classe que l'on peut comparer à un plan ou un modèle qui sert à construire des objets "date".
// On construit un objet "date" avec le mot new, en indiquant la date qui nous intéresse entre parenthèses. $date est donc un objet date. 
// Cette objet bénéficie de méthodes (=fonctions) offertes par la classe : il y a entre autre la méthode format() qui permet de modifier le format d'une date. Pour appeler cette méthode sur l'objet $date, on utilise la flèche "->". 

// -------------------------------------------------