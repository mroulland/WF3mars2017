<?php

	/* Création de l'objet PDO */
	$dsn = 'mysql:host=localhost;dbname=movies;charset=utf8';
	$pdo = new PDO($dsn, 'root', '');

	/* Afficher les erreurs */
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	