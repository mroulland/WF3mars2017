<?php
$a=10; $b=5; $c=2;
if($a == 8)	echo "1";
elseif($a != 10) echo "2";
else echo "3";


    $mysqli = new mysqli("localhost", "root", "", "repertoire");

    if(isset($_POST['inscription'])){
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        foreach($_POST as $indice => $valeur){
            
        }
    }




?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Formulaire répertoire</title>
        <style>

            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html{
                font-size: 62.5%;
            }
            fieldset{
                padding: 2rem;
                margin: 2rem auto;
            }
            form{
                width: 60rem;
                margin: auto;
            }
            input:not([name="sexe"] ), textarea{
                display: block;
                width:100%;
                padding: 0.5rem;
                background-color: rgba(72, 61, 139, 0.2);
                border: none;
                box-shadow: 0.1rem 0.1rem 0.3rem darkslateblue;
                margin: 1rem 0;
            }

            b{
                font-size: 1rem;
            }

            [name="sexe"]{
                margin: 1rem auto;
            }

            label, legend{
                font-size: 1.5rem;
                color: darkslateblue;
                font-weight: bold;
                margin-bottom: 0.2rem;
                display: block;
            }

        </style>
    </head>

    <body>
        <form method="post" action="">
            <fieldset>
                <legend>Informations</legend>

                <label for="nom" id="nom">Nom :</label>
                <input type="text" id="nom" name="nom">

                <label for="prenom" id="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom">

                <label for="telephone" id="telephone">Téléphone :</label>
                <input type="text" id="telephone" name="telephone">

                <label for="profession" id="profession">Profession :</label>
                <input type="text" id="profession" name="profession">

                <label for="ville" id="ville">Ville :</label>
                <input type="text" id="ville" name="ville">

                <label for="codepostal" id="codepostal">Code Postal :</label>
                <input type="number" id="codepostal" name="codepostal">

                <label for="adresse" id="adresse">Adresse :</label>
                <textarea name="adresse" id="adresse"></textarea>

                <label for="date_de_naissance" id="date_de_naissance">Date de Naissance :</label>
                <label for="jour">Jour</label>
                <select name="jour" id="jour">
                    <?php for($i=1; $i <= 31; $i++)
                        if($i<=9){
                            echo "<option>0$i</option>";
                        }
                        else{
                            echo "<option>$i</option>";
                        }
                    ?>
                </select>
                <label for="mois">Mois</label>
                <select name="mois" id="mois">
                    <option value="01">Janvier</option>
                    <option value="02">Février</option>
                    <option value="03">Mars</option>
                    <option value="04">Avril</option>
                    <option value="05">Mai</option>
                    <option value="06">Juin</option>
                    <option value="07">Juillet</option>
                    <option value="08">Aout</option>
                    <option value="09">Septembre</option>
                    <option value="10">Octobre</option>
                    <option value="11">Novembre</option>
                    <option value="12">Décembre</option>
                </select>

                <label for="annee">Année</label>
                <select name="annee" id="annee">
                    <?php
                        for($i = date("Y"); $i >= 1930; $i--)
                        {
                            echo "<option value='. $i .'>$i</option>";
                        }
                    ?>
                </select>



                <label for="sexe" id="sexe">Sexe :</label>
                <input type="radio" id="sexe" name="sexe" value="homme"><b>Homme</b>
                <input type="radio" id="sexe" name="sexe" value="femme"><b>Femme</b>

                <label for="description" id="description">description :</label>
                <textarea name="description"></textarea>

                <input type="submit" value="inscription" name="inscription">

            </fieldset>
        </form>


    </body>
</html>