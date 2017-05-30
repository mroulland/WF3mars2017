<?php 
// 09-namespaces
    // -> appel.php

namespace General;

require('espace1.php');
require('espace2.php'); 

use Espace1;
use Espace2;
// use Espace1, Espace2; // marche très bien aussi

use PDO; // Lorsqu'on est dans un namespace défini (Général) et que l'on souhaite utiliser une classe existante dans l'espace global de PHP (ex: PDO ou Mysqli), alors on doit importer la classe avec l'instruction USE. 

// De manière générale, on doit toujours importer les namespaces (use) dont on a besoin. 

$c = new Espace1\A;
echo $c -> test1();

$d = new Espace2\A;
echo $d -> test2();

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root', '');