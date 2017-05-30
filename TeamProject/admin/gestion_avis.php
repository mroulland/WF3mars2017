<?php

require_once('../inc/init.inc.php');


$resultat = executeRequete('SELECT * FROM avis');
$content .= '<h3>Avis</h3>
			 <table border=".2rem solid grey">';
		$content .= '<tr>
                        <th>Id_avis</th>
						<th>Id_membre</th>
						<th>Id_salle</th>
                        <th>Commentaire</th>
                        <th>Note</th>
                        <th>Date d\'enregistrement</th>
						<th>Actions</th>
					</tr>';

while ($avis = $resultat->fetch(PDO::FETCH_ASSOC)){
		$content .= '<tr>
						<td>'. $avis['id_avis'] .'</td>
						<td>'. $avis['id_membre'] .'</td>
						<td>'. $avis['id_salle'] .'</td>
						<td>'. $avis['commentaire'] .'</td>
						<td>'. $avis['note'] .'</td>
						<td>'. $avis['date_enregistrement'] .'</td>
						
						<td>
							<a href="?id_avis='. $avis['id_avis'] .'"><i class="fa fa-search" aria-hidden="true"></i></a>
                            <a href="?action=modifier&id_avis='. $avis['id_avis'] .'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <a href="?action=vider&id_avis='. $avis['id_avis'] .'"><i class="fa fa-trash" aria-hidden="true"></i></a>
						</td>
					</tr>';
	}			
			
$content .= '</table>';




require_once('../inc/haut.inc.php');



require_once('../inc/bas.inc.php');
