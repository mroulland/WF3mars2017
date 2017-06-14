<?php

	require_once('inc/connect.php'); // Récupération de $pdo (Instance de PDO)
	require_once('inc/functions.php');

	// Récupération de tous les films
	$movies = getAllMovies($pdo);
	$moviesByVues = getMoviesByVues($pdo);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ciné Phil</title>
	<link rel="stylesheet" href="assets/styles.css">
</head>

<body>

	<section>
		<?php 
			// foreach()
		?>
	</section>
	<section id="list-movies">
		<ul>
		<?php foreach($movies as $movie) : ?>
			<li>
				<form action="#" method="POST" id="form">
					<button type="submit" name="add-view" value="<?= $movie['id'] ?>">Ajouter une vue</button>
					<?= $movie['title'] ?> (<i><?= $movie['genre_name'] ?></i>)
				</form>
			</li>
		<?php endforeach ?>
		</ul>
	</section>
	<section id="table-movies">
		
		<!-- Tableau de statistiques -->
		<?php 			
			echo '<table border="1" padding="1">
				<tr>
					<th>Titre</th>
					<th>Date de sortie</th>
					<th>Nombre de vues</th>
				</tr>';

			foreach($moviesByVues as $indice){
				echo '<tr>
						<td>'. $indice['title'] .'</td>
						<td>'. $indice['release_date'] .'</td>
						<td>'. $indice['nb_viewers'] .'</td>
					 </tr>';
			}

			echo '</table>';

			
	?>
			
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
        <script>

			var formulaire = document.getElementById("form").addEventListener("submit", ajax);

			function ajax(event){
                event.preventDefault();

				// on déclenche une fonction ajax qui envoie vers functions.php 
				var file = "inc/functions.php";
				var xhttp = new XMLHttpRequest();
				xhttp.open("POST", file, true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                xhttp.onreadystatechange = function() { 
                    if(xhttp.readyState == 4 && xhttp.status == 200){
                        console.log(xhttp.responseText);
                        var reponse = JSON.parse(xhttp.responseText);
                        document.getElementById("table-movies").innerHTML = reponse.resultat; 
                    }
                }
                xhttp.send(); // envoi 
			}


		</script>




	</section>
</body>
</html>
