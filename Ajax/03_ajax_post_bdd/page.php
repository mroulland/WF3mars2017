<?php 
    $pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    $query = $pdo->query("SELECT prenom, id_employes FROM employes");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <style>
            * { font-family: sans-serif; text-align: center;}
            form{ width: 50%; margin: auto; }
            select, input{ padding: 5px; width: 100%; border-radius: 3px; border: 1px solid; margin : 10px auto;}
            input{cursor:pointer;}
            table{ border-collapse: collapse; width: 80%; margin: 0 auto;}
            td, th{ padding: 10px;}
        </style>
    </head>

    <body>
        <form id="mon_form" action="">
            <label for="">Prénom</label>
            <select id="choix">
                <?php
                    // récupérer tous les noms présents dans la BDD et mettre l'id_employes dans la value'
                    while($personne = $query->fetch(PDO::FETCH_ASSOC)){
                        echo '<option value="' . $personne[id_employes].'">'. $personne[prenom] .'</option>';
                    }
                ?>
            </select> <br>

            <input type="submit" id="valider" value="Valider">
        </form>

        <hr>
        <div id="resultat"></div>

        <script>
            // Mettre en place un évènement sur la validation du formulaire (submit)
            var formulaire = document.getElementById("mon_form").addEventListener("submit", ajax);

            // bloquer le rechargement de page consécutif à la validation du formulaire

            function ajax(event){
                event.preventDefault();

                var choix = document.getElementById("choix");
                var id_employe = choix.value;
                console.log(id_employe);
            

                // et déclencher une requete ajax qui envoie sur ajax.php
                var file = "ajax.php";
                var xhttp = new XMLHttpRequest();

                var parametres = "personne="+id_employe;

                xhttp.open("POST", file, true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhttp.onreadystatechange = function() {  // on vérifie l'état
                    if(xhttp.readyState == 4 && xhttp.status == 200){
                        console.log(xhttp.responseText);
                        var reponse = JSON.parse(xhttp.responseText);
                        document.getElementById("resultat").innerHTML = reponse.resultat; 
                    }
                }
                xhttp.send(parametres); // envoi 
            }
                // sur ajax.php récupérer les informations de l'employes correspondant à l'id récupéré
                // et envoyer une réponse sous forme de tableau html. Le tableau doit avoir deux lignes, une avec le nom des colonnes et l'autre avec les valeurs

        </script>
    </body>
</html>