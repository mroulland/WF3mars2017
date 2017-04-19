--*****************************
-- Fonctions prédéfinies
--*****************************
-- Fonctions prédéfinies : prévue par le langage SQL et exécutée par le développeur.

-- Dernier Id inséré : 
INSERT INTO abonne (prenom) VALUES ('test');
SELECT LAST_INSERT_ID();  -- Permet d'afficher le dernier identifiant inséré


--- Fontions de dates : 
SELECT *, DATE_FORMAT(date_rendu, '%d-%m-%Y') AS date_rendu_fr FROM emprunt; 
-- met les dates du champ date_rendu_fr au format JJ-MM-AAAA

SELECT NOW(); -- Affiche la date et l'heure en cours

SELECT DATE_FORMAT(NOW(), '%d-%m-%Y %H:%i:%s'); 

SELECT CURDATE(); -- retourne la date du jour au format YYYY-MM-DD
SELECT CURTIME(), -- retourne l'heure courante au format hh:mm:ss

-- Crypter un mot de passe avec l'algorithme AES :
SELECT PASSWORD ('mypass'); -- Affiche 'mypass' crypté par l'algorythme AES
INSERT INTO abonne (prenom) VALUES (PASSWORD('mypass')); -- Insère le mdp crypté en base

-- Concaténation : 
SELECT CONCAT('a', 'b', 'c'); -- Concatène les 3 chaines de caractères 
SELECT CONCAT_WS(' - ', 'a', 'b', 'c'); -- concat with separator : concaténation avec un séparateur

-- Fonction sur les chaînes de caractères : 
SELECT SUBSTRING('bonjour', 1, 3); -- Affiche 'bon' : compte 3 à partir de la position 1
SELECT TRIM('         bonjour       '); -- Supprime les espaces avant et après la chaîne de caractères


-- Source pour trouver des fonctions : sql.sh
