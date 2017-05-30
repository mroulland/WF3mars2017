<?php
require_once('inc/init.inc.php');

$tab=array();
$tab['resultat'] = '';

$mode = isset($_POST['mode']) ? $_POST['mode'] : '';
$arg = isset($_POST['arg']) ? $_POST['arg'] : '';  

$liste = file("prenom.txt");

if($mode == "liste_membre_connecte" && empty($arg)){

    // récupérer le contenu du fichier prenom.txt (file())
    // placer dans $tab['resultat'] le contenu de ce fichier sous la forme '<p>pseudo1</p><p>pseudo2</p>'
    foreach($liste as $valeur){
        $tab['resultat'] .= '<p>' . $valeur . '</p>';
    }

}
elseif($mode == 'postMessage'){
    // On test s'il y a bien un message a enregistrer 
    $arg = trim($arg); // on enlève les espaces avant et après la chaine ainsi que si le message ne possède que des espaces.
    if(!empty($arg)) // si le message n'est pas vide, alors on lance un insert into
    {
        // $position = strpos($arg, ">");
        // $arg = substr($arg, $position);
        // Matthieu > Bonjour à tous   => Enregistrera juste "Bonjour à tous"
        // Ces deux lignes précédentes sont à décommenter si l'on enregistre avec le pseudo et le chevron

        $arg = addslashes($arg); // met un \ devant les ' et les "
        // Enregistrement du message
        $pdo->query("INSERT INTO dialogue (id_membre, message, date) VALUES ($_SESSION[id_membre], '$arg', NOW())"); 

        $tab['resultat'] = "Message enregistré !";
    }

}
elseif($mode == "message_tchat"){
    // on récupère tous les messages de la table dialogue
    // traitement de l'objet résultat avec un while pour placer la réponse dans $tab['resultat']

    $message = $pdo-> query("SELECT membre.pseudo, membre.civilite, dialogue.message, dialogue.date FROM dialogue, membre WHERE membre.id_membre = dialogue.id_membre ORDER by dialogue.date");   


    while($resultat = $message->fetch(PDO::FETCH_ASSOC)){
        if($resultat['civilite'] == 'm'){
            $tab['resultat'] .= '<p><span class="bleu">' . ucfirst($resultat['pseudo']) . '</span> > ' . $resultat['message'] .'</p>'; // ucfirst permet de mettre la première lettre en majuscule
        } else {
            $tab['resultat'] .= '<p><span class="rose">' . ucfirst($resultat['pseudo']) . '</span> > ' . $resultat['message'] .'</p>';
        }
    }
} elseif($mode = 'liste_membre_connecte' && !empty($arg)){
    // si $arg n'est pas vide alors on a un pseudo et nous devons le retirer du fichier prenom.txt
    $contenu = file_get_contents('prenom.txt'); // on récupère le contenu du fichier prenom.txt dans la variable $contenu
    $contenu = str_replace($arg, "", $contenu); // on remplace le pseudo par rien
    file_put_contents('prenom.txt', $contenu); // on écrase l'ancien contenu par le nouveau où l'on a supprimé le pseudo concerné
}
// var_dump($liste); 
echo json_encode($tab);