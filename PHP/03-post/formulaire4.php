<link rel="stylesheet" href="css/style.css">

<h1>Formulaire 4</h1>

<article>

    <?php 
    if(!empty($_POST)){
        if(!empty($_POST['pseudo'])){
            echo 'Pseudo : ' . $_POST['pseudo'] . '<br>';
        } else {
            echo 'Le pseudo est vide' . '<br>';
        }

        echo '@Email : ' . $_POST['email'] . '<br>'; 

    } else{
       echo 'Vous ne remplissez pas les critères';
    }

    ?>
</article>