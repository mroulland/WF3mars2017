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
echo '<h2>Les fonctions utilisateurs</h2>';
// -------------------------------------------------
// Les fonctions qui ne sont pas prédéfinies dans le lagage sont déclarées puis executées par l'utilisateur. 

// Déclaration d'une fonction :
function separation() {
    echo '<hr>';    // Simple fonction permettant de tirer un trait dans la page web
}

// Appel de la fonction par son nom : 
separation();   // Ici, on exécute la fonction


// --------
// Fonction avec arguments : les arguments sont des paramètres fournis à la fonction et lui permettent de compléter ou modifier son comportement initialement prévu. 

function bonjour($qui){   // $qui apparait ici pour la première fois : il s'agit d'une variable de réception qui reçoit la valeur d'un argument
    return 'Bonjour ' . $qui . '<br>';   // return permet de renvoyer ce qui suit le return à l'endroit où la fonction est appelée. 
    echo 'Cettte ligne ne sera pas executée';  // Après un return, on quitte la fonction donc on n'exécute pas le code qui suit. 
}

// Appel de la fonction : 
echo bonjour('Pierre');  // On appelle la fonction en lui donnant le string 'Pierre' en argument => affiche "Bonjour Pierre". 

$prenom = 'Etienne';
echo bonjour($prenom);   // L'argument peut être une variable : affiche "Bonjour Etienne". 

// 
// Exercice :
function appliqueTva($nombre){
    return $nombre * 1.2;
}


// Ecrivez une fonction appliqueTva2 sur la base de la précédente, mais en donnant la possibilité de calculer un nombre avec le taux de notre choix. 
function appliqueTva2($nombre, $taux){ // On ne peut pas redéclarer une fonction avec le même nom 
    return $nombre * $taux;
}

echo appliqueTva2(2000, 1.5) . '<br>';  // Lorsqu'une fonction attend des arguments, il faut obligatoirement les lui donner

// ----------------
// Exercice : 
function meteo($saison, $temperature){
    echo "Nous sommes en $saison et il fait $temperature degré(s) <br>";
}

meteo('hiver', 2);
meteo('printemps', 2);

echo '<br>';

// Créer une fonction meteo2 qui permet d'afficher "au printemps" quand il s'agit du printemps.

function meteo2($saison, $temperature){
    if($saison == 'printemps'){
        $article = 'au';
    } else{
        $article = 'en';
    }
    echo "Nous sommes $article $saison et il fait $temperature degré(s) <br>";
}

meteo2('printemps', 7);
meteo2('hiver', 3);

echo '<br>';


function meteo3($saison, $temperature){
    $article = ($saison == 'printemps') ? 'au' : 'en';
    echo "Nous sommes $article $saison et il fait $temperature degré(s) <br>";
}

meteo3('été', 25);
meteo3('hiver', -5);



// Exercice : 
function prixLitre(){
    return rand(1000, 2000)/1000;  //détermine un prix aléatoire entre 1 et 2€
}
  
// Ecrivez la fonction factureEssence() qui calcule le prix total de votre facture d'essence en fonction du nombre de litres que vous lui donnez. Cette fonction retourne la phrase "Votre facture est de X euros pour Y litres d'essence" (X et Y sont variables). 
// Dans cette fonction, utilisez la fonction prixLitre() qui vous retourne le prix du litre d'essence.

function factureEssence($litre){
    $prixTotal = prixLitre() * $litre;
    echo "Votre facture est de $prixTotal € pour $litre litres d'essence";
}

factureEssence(30);




// -------------------------------------------------
echo '<h2>Les variables locales et globales</h2>';
// -------------------------------------------------

function jourSemaine(){
    $jour = 'vendredi';  // ici dans la fonction nous sommes dans un espace LOCAL. La varibale $jour est donc LOCALE.  
    return $jour;
}

// A l'extérieur de la fonction, je suis dans l'espace GLOBAL. 

// echo $jour;  // Je ne peux pas utiliser une variable locale dans l'espace global.
echo jourSemaine() . '<br>';  // On peut cependant récupérer la valeur de $jour grâce au return qui est au sein de la fonction et à l'appel de cette fonction. 


// -----------------
$pays = 'France';  // Variable gloable
function affichagePays(){
    global $pays;   // Le mot clé global permet de récupérer une variable provenant de l'espace global au sein de l'espace local de la fonction
    echo $pays;  // On peut donc utiliser cette variable $pays 
}

affichagePays();


// -------------------------------------------------
echo '<h2> Les structures itératives : boucles </h2>';
// -------------------------------------------------
// boucle while
$i = 0; // valeur de départ de la boucle
while ($i < 3 ){  // Tant que $i est inférieur à 3, j'exécute les accolades qui suivent'
    echo "$i---";
    $i++;   // On n'oublie pas d'incrémenter $i pour que la boucle ne soit pas infinie (il faut que la condition puisse devenir false à un moment donné)
}

echo '<br>';

$i=0;

while ( $i < 3 ){
    if($i<2){
        echo "$i---";
    } else{
        echo "$i";
    }
    $i++;   
}

echo '<br>';
echo '<br>';

// -----------
// Exercice : à l'aide d'une boucle while, afficher dans un sélecteur les années depuis l'année en cours moins 100 ans et jusqu'a l'année en cours : 1917 - 2017

$currentYear = date('Y');
echo $currentYear . '<br>';

$a = $currentYear - 100;

echo "<select>"; 
while ($a <= $currentYear){
    echo "<option> $a </option>";
    $a++;
}
echo "</select>";

// ----------
echo '<br>';
// ----------

$currentDate = date('Y');
$a = $currentDate - 100;

echo "<select>";
while ($currentDate >= $a){
    echo "<option>$currentDate</option>";
    $currentDate--; 
}
echo "</select>";



// -----------------------------------------
// Boucle do while : 
// La boucle do while a la particularité de s'exécuter au moins UNE fois, puis tant que la condition de fin est vraie.

echo '<br>Boucle do while <br>';

do{
    echo 'un tour de boucle';
} while (false);  // On met la condition pour exécuter les tours de boucle ici, à la place de false. Dans ce cas précis, on voit que l'on effectue un tour de boucle bien que la condition soit fausse. 

// Notez la présence du point virgule à la fin de la boucle do while (contrairement aux autres structures itératives). 

// ----------------------------------------------
// Boucle for : 
echo '<br>';
for ($j = 0; $j < 16; $j++ ){ // Initialisation de la valeur de départ ; condition d'entrée dans la boucle ; incrémentation (ou décrémentation)
    print $j . '<br>';
}
echo '<br>';

// -------
// Exercice : 
// 1- Faire une boucle qui affiche 0 à 9, sur la même ligne.

for($h = 0; $h <= 9; $h++){
    print $h;
}

echo '<br>';

// 2- Faites la même chose mais dans un tableau HTML.   
echo "<table border='1'><tr>";
for($h = 0; $h <= 9; $h++){
    print "<td>$h</td>";
}
echo "</tr></table>";


// ----------------------------
echo '<br>';echo '<br>';echo '<br>';
// ----------------------------

// Exercice : Faire un tableau HTML de 10 colonnes sur 10 lignes à partir du code précédent 
echo "<table border='1'>";
    for( $k = 0; $k < 10; $k++ ){
        echo "<tr>";
            for($h = 0; $h < 10; $h++){
                print "<td>$h</td>";
            }
        echo "</tr>";
    }
echo "</table>";

// ----------------------------
echo '<br>'; echo "<hr>"; echo '<br>';
// ----------------------------

//  Version en while : 

echo "<table border='1'>";
    //On fait une boucle pour les lignes : 
    $i = 0;
    while($i < 10){
        echo '<tr>';
        // On fait une boucle pour les colonnes :
            for($h = 0; $h <= 9; $h++){
                print "<td>$h</td>";
            }
        $i++;
        echo "</tr>";
    }

echo "</table>";

// ----------------------------
echo '<br>'; echo "<hr>"; echo '<br>';
// ----------------------------

$contenu = 0;
echo "<table border='1'>";
    for( $k = 0; $k < 10; $k++ ){
        echo "<tr>";
            for($h =0; $h < 10; $h++){
                print "<td>$contenu</td>";
                $contenu++;
            }
        echo "</tr>";
    }
echo "</table>";



// -------------------------------------------------
echo '<h2> Les array ou tableaux </h2>';
// -------------------------------------------------
// On peut stocker dans un array une multitude de valeurs, quelque soit leur type. 

$liste = array('Grégoire', 'Nathalie', 'Emilie', 'François', 'Georges'); // Déclaration d'un array appelé $liste et contenant des prénoms

 // echo $liste; // Erreur car on ne peut pas afficher directement le contenu d'un array

echo '<pre>'; var_dump($liste); echo '</pre>';
echo '<pre>'; print_r($liste); echo '</pre>';
// Ces deux instructions d'affichage permettent d'indiquer le type de l'élement mis en argument ainsi que son contenu. Les balises <pre> servent à faire une mise en forme. 
// Notez que ces deux instructions ne sont utilisées qu'en phase de développement. 
 

// Autre moyen d'affecter des valeurs dans un tableau : 
$tab[] = 'France';  // Permet d'ajouter la valeur 'France' dans le tableau $tab
$tab[] = 'Italie';  
$tab[] = 'Espagne';
$tab[] = 'Portugal';  

print_r($tab); // Pour voir le contenu du tableau 

// Pour afficher la valeur Italie qui se situe à l'indice 1 :
echo $tab[1] . '<br>'; // Affiche Italie

//  Tableau associatif : tableau dont les indices sont littéraux :
$couleur = array("j" => "jaune", "b" => "bleu", "v" => "vert");   // On peut choisir le nom des indices. 

// Pour accéder à un élément du tableau associatif : 
echo 'la seconde couleur de notre tableau est le ' . $couleur['b'] . '<br>'; // Affiche bleu
echo "la seconde couleur de notre tableau est le $couleur[b]";  // affiche bleu. Un array écrit dans des guillements perd ses quotes autour de son indice (sous peine de déclencher une erreur de syntaxe)

// ----------------
// Mesurer la taille d'un array : 
echo 'Taille du tableau : ' . count($couleur) . '<br>'; // Compte le nombre d'éléments dans l'array $couleur, ici 3
echo 'Taille du tableau : ' . sizeof($couleur) . '<br>'; // Compte le nombre d'éléments dans l'array $couleur ici 3

// ----------------
// Transformer un array en string :
$chaine = implode('-', $couleur);   // implode() rassemble les éléments d'un array en une chaîne séparés par le séparateur '-' ici
echo $chaine . '<br>';

$couleur2 = explode('-', $chaine);  // Transforme une chaine en array en séparant les éléments grâce au séparateur indiqué (ici un "-"). $couleur2 est un array aux indices numériques
print_r($couleur2);


// -------------------------------------------------
echo '<h2> La boucle foreach pour parcourir les arrays </h2>';
// -------------------------------------------------
// La boucle foreach est un moyen simple de passer en revue un tableau. Elle fonctionne uniquement sur les arrays et les objets. Et elle a l'avantage d'être "automatique", s'arrêtant quand il n'y a plus d'éléments.

echo '<pre>';print_r($tab); 

foreach($tab as $valeur){  // La variable $valeur (que l'on appelle comme on veut) récupère à chaque tour de boucle les valeurs qui sont parcourues dans l'array $tab. ["parcourt l'array $tab par ses valeurs"]
    echo $valeur . '<br>';
}

foreach($tab as $indice => $valeur) { // On parcourt l'array $tab par ses indices auxquels on associe les valeurs. Quand il y a deux valeurs, la première parcourt la colonne des indices et la secondes la colonne des valeurs. Ces variables peuvent avoir n'importe quel nom. 
    echo $indice . 'correspond' . $valeur . '<br>';
}



//-------------------------------------------
echo '<h2> Les arrays multidimensionnels </h2>';
//-------------------------------------------
// Nous parlons de tableaux multidimensionnels quand un tableau est contenu dans un autre tableau. Chaque tableau représente une dimension.

// Création d'un tableau multidimensionnel :
$tab_multi = array(
        0 => array('prenom' => 'Julien', 'nom' => 'Dupon', 'telephone' => '06 00 00 00 00'),
        1 => array('prenom' => 'Nicolas', 'nom' => 'Duran', 'telephone' => '06 00 00 00 00'),
        2 => array('prenom' => 'Pierre', 'nom' => 'Duchemol')

);

echo '<pre>'; print_r($tab_multi); echo '</pre>';


// Accéder à la valeur Julien :
echo $tab_multi [0]['prenom'] . '<br>';    // affiche Julien : nous entrons d'abord  à l'indice 0 pour aller ensuite dans l'autre tableau à l'indice 'prenom'. Notez que 'prenom' est un string.

// Parcourir le tableau multidimensionnel avec une boucle for :
for ($i = 0; $i < count($tab_multi); $i++){
    echo $tab_multi[$i]['prenom'] . '<br>';
}

// Exercice : afficher les prénoms avec une boucle foreach:


foreach ($tab_multi as $i => $v ){ 
    // Première version en passant par l'indice :
    echo $tab_multi[$i]['prenom']. '<br>';

    // Seconde version en passant par la valeur:
    // print_r($v);
    echo  $v ['prenom'] . '<br>'. $v['nom'] . '<br>'. $v['telephone'] . '<br>';
}

echo '<hr>';
//-------------------------------------------
echo '<h2> Les inclusions de fichiers </h2>';
//-------------------------------------------

echo 'Première inclusion ';
include('exemple.inc.php'); // on inclut le fichier dont le chemin est spécifié

echo '<br>Deuxième inclusion';
include_once('exemple.inc.php');  // avec le once, on vérifie d'abord si le fichier n'est pas déjà inclus avant de faire l'inclusion (évite par exemple de redéclarer des fonctions en incluant deux fois le même fichier)


echo '<br>Troisième inclusion';
require ('exemple.inc.php');  // require fait la même chose que include mais génère une erreur de type fatale s'il ne parvient pas à inclure le fichier qui interrompt l'exécution du scipt. En revanche, include génère une erreur de type warning dans ce cas, ce qui n'interrompt pas la suite de l'exécution du script. 

echo '<br>Quatrième inclusion';
require_once('exemple.inc.php');  // Avec le once, on vérifie d'abord si  le fichier n'est pas déjà inclus avant de faire l'inclusion

// Le ".inc" du nom du fichier inclus est là à titre indicatif pour préciser qu'il s'agit d'un fichier inclus et non pas d'un fichier directement utilisé. 



echo '<hr>';

//-------------------------------------------
echo '<h2> Introduction aux objets </h2>';
//-------------------------------------------
// Un objet est un autre type de données. Un objet est issu d'une classe qui possède des attributs (encore appeleées propriétés) et des méthodes (équivalentes de fonctions). 
// L'objet crée à partir d'une classe, peut accéder à ses attributs et ses méthodes. 

// Exemple avec un personnage de type 'Etudiant' :
class Etudiant {  // comme après function on écrivait le nom de la fonction, ici on écrit class et le nom de la class. Le nom prend toujours une majuscule. 
    public $prenom = 'Julien';  // public pour préciser que l'élement est accessible partout et donc en dehors de la classe. 
    public $age = 25;  // $age est un attribut ou propriété 
    public function pays(){ // methode appelée pays
        return 'France';
    }

} 

$objet = new Etudiant(); // new permet de créer un nouvel objet. On instancie la class Etudiant en un objet appelé $objet. $objet est une instance de la classe Etudiant. 

echo '<pre>'; print_r($objet); echo '</pre>'; // Ici, on regarde le contenu de $objet, on voit son type, et la classe dont il est issu. 

// Afficher le prénom de l'étudiant $objet : 
echo $objet->prenom . '<br>'; // nous pouvons accéder à une propriété d'un objet en mettant une flèche "->". Affiche "Julien"

// Afficher le pays via la méthode pays() : 
echo $objet->pays() . '<br>'; // on appelle la méthode pays() avec ses parenthèses : elle nous retourne 'France'

// Contexte : ssur un site, une classe Panier contiendra les propriétés et les méthodes nécessaires au fonctionnement du panier d'achat : 

class Panier {
    public function ajout_article($article) {
        // instructions qui ajoutent le produit au panier
        return "L\'article $article a bien été ajouté au panier <br>";

    }
    
}

// Lorsqu'on clique sur le bouton "ajout au panier" : 
$panier = new Panier();   // On crée un panier vide dans un premier temps
echo $panier->ajout_article('Pull');   // puis on ajoute un Pull au panier en appelant la méthode ajout_article()


// QUAND C'EST UN ARRAY C'EST DES CROCHETS, QUAND C'EST UN OBJET C'EST DES FLECHES

// ************************************************
