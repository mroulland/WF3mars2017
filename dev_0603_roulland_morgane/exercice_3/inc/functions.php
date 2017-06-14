<?php

	/**
	 * Récupère en base de données l'ensemble des films, triés par titre
	 * @param  PDO $pdo Objet PDO, connexion à la base de données
	 * @return mixed Les films (tableau associatif)
	 */
	function getAllMovies($pdo) {
		$sql = 'SELECT movies.id, movies.title, genres.name AS genre_name FROM movies INNER JOIN genres ON movies.id_genre = genres.id ORDER BY movies.title';
		$stmt = $pdo->query($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function getMoviesByVues($pdo){
		$sql = 'SELECT movies.id, movies.title, movies.release_date, movies.nb_viewers,genres.name AS genre_name FROM movies INNER JOIN genres ON movies.id_genre = genres.id ORDER BY movies.nb_viewers DESC, movies.release_date DESC LIMIT 1, 10';

		$stmt = $pdo->query($sql);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}



// Fonction AJAX 

// Requête SQL (vue ci-dessus)
$sql = 'SELECT movies.id, movies.title, movies.release_date, movies.nb_viewers,genres.name AS genre_name FROM movies INNER JOIN genres ON movies.id_genre = genres.id ORDER BY movies.nb_viewers DESC, movies.release_date DESC LIMIT 1, 10';
$stmt = $pdo->query($sql);


$tab = array(); 

$tab['resultat'] = "<table border='1'><tr>";

while($resultat = $stmt->fetch(PDO::FETCH_ASSOC)){

	$tab['resultat'] .= "<tr>
							<td>$resultat[title]</td></tr>
							<td>$resultat[release_date]</td>
							<td>$resultat[nb_viewers]</td>";
	$tab['resultat'] .= '<tr>';
}

$tab['resultat'] .= '</tr></table>';

echo json_encode($tab);