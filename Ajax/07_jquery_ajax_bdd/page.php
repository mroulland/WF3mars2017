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

        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
        <script>
           $(document).ready(function(){
                // lorsque le document est prêt (chargé)
                $("#mon_form").on('submit', function(e){
                    e.preventDefault();

                    var url = "ajax.php";
                    var personne = $("#choix").val();
                    var parametres = "personne="+personne;

                    $.ajax({
                        url: url,
                        type: "POST",
                        data: parametres,
                        dataType: "json",
                        success: function(reponse){
                            $("#resultat").html(reponse.resultat); 
                        }
                    });
                });

           });
        </script>
    </body>
</html>