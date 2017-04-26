-- **************************
-- CREATION DE LA BDD
-- **************************

CREATE DATABASE bibliotheque;

USE bibliotheque;

-- copie / colle le contenu de bibliotheque.sql dans la console

-- **************************
-- Exercices
-- **************************

-- 1. Quel est l'id_abonne de Laura ?
SELECT id_abonne FROM abonne WHERE prenom = 'Laura';

-- 2. L'abonné d'id_abonne 2 est venu emprunter un livre à quelles dates ?
SELECT date_sortie, date_rendu FROM emprunt WHERE id_abonne = 2;

-- 3. Combien d'emprunts ont été effectués en tout ? 
SELECT COUNT(id_emprunt) FROM emprunt;

-- 4. Combien de livres sont sortis le 2011-12-19 ?
SELECT COUNT(id_livre) FROM emprunt WHERE date_sortie = "2011-12-19";

-- 5. Une Vie est de quel auteur ?
SELECT auteur FROM livre WHERE titre = "Une Vie";

-- 6. De combien de livres d'Alexandre Dumas dispose-t-on ?
SELECT COUNT(titre) FROM livre WHERE auteur = "Alexandre Dumas";

-- 7. Quel id_livre est le plus emprunté ? 
SELECT id_livre, COUNT(id_livre) AS nombre FROM emprunt GROUP BY id_livre ORDER BY nombre DESC LIMIT 0,1;
SELECT id_abonne, id_emprunt FROM emprunt GROUP BY id_emprunt;

-- 8. Quel id_abonne emprunte le plus de livres ?
SELECT id_abonne, COUNT(id_livre) AS nombre FROM emprunt GROUP BY id_abonne ORDER BY nombre DESC LIMIT 0,1;







-- **************************
-- Les requêtes imbriquées
-- **************************

-- Syntaxe "aide mémoire" de la requête imbriquée : 
-- SECLECT a FROM table_de_a WHERE b IN (SELECT b FROM table_de_b WHERE condition);

-- Afin de réaliser une requête imbriquée, il faut obligatoirement un champ en COMMUN entre les deux tables. 

-- Un champs NULL se teste avec IS NULLL :
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL; -- affiche les id_livres non rendus

-- Afficher les titres de ces livres non rendus
SELECT titre FROM livre WHERE id_livre IN 
    (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);

-- Afficher le numéro des livres que Chloé a emprunté 
SELECT id_livre FROM emprunt WHERE id_abonne = (SELECT id_abonne FROM abonne WHERE prenom = 'chloe'); -- Quand il n'y a qu'un seul résultat dans la requête imbriquée, on met un signe "="


-- EXERCICE : afficher le prénom des abonnés ayant emprunté un livre le 19-12-2011
SELECT prenom FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE date_sortie = '2011-12-19');


-- EXERCICE : Afficher le prénom des abonnés ayant emprunté un livre d'Alphonse Daudet :
SELECT prenom FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE id_livre IN (SELECT id_livre FROM livre WHERE auteur = 'Alphonse Daudet') );

-- EXERCICE : Afficher le ou les titres de livres que Chloé a emprunté(s) : 
SELECT titre FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE id_abonne = ( SELECT id_abonne FROM abonne WHERE prenom = 'chloe'));

-- EXERCICE : Afficher le ou les titres de livres que Chloé n'a pas encore rendu(s) : 
SELECT titre FROM livre WHERE id_livre IN
    (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL 
    AND id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = 'chloe'));

-- EXERCICE : Combien de livres Benoit a emprunté :
SELECT COUNT(id_livre) FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = 'benoit');

-- EXERCICE : Qui (prénom) a emprunté le plus de livre ? 
SELECT prenom FROM abonne WHERE id_abonne = (SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(id_emprunt) DESC LIMIT 0,1);
    -- Remarque : on ne peut pas utiliser LIMIT dans IN mais obligatoirement dans un "="







-- **************************
-- Les jointures internes
-- **************************

-- Différence entre une jointure et une requête imbriquée : une requête imbriquée est possible seulement dans le cas où les champs affichés (ceux qui sont dans le SELECT) sont issus de la même table. 

-- Avec une requête de jointure, les champs sélectionnés peuvent être issus de tables différentes. Une jointure est une requête permettant de faire des relations entre les différentes tables afin d'avoir des colonnes ASSOCIEES qui ne forme qu'UN SEUL résultat. 

-- Afficher les dates de sortie et de rendus pour l'abonné Guillaume : 
SELECT a.prenom, e.date_sortie, e.date_rendu 
FROM abonne a
INNER JOIN emprunt e
ON a.id_abonne = e.id_abonne
WHERE a.prenom = 'guillaume';

-- 1ère ligne : ce que je souhaite afficher
-- 2ème ligne : la 1ere table d'où proviennent les informations
-- 3ème ligne : la seconde table d'où proviennent les informations
-- 4ème ligne : la jointure qui lie les deux tables avec le champ COMMUN
-- 5ème ligne : la ou les conditions supplémentaires

-- EXERCICE : Nous aimerions connaître les mouvements des livres (titre, date sortie, date rendu) écris par Alphone Daudet

SELECT l.titre, e.date_sortie, e.date_rendu
FROM livre l
INNER JOIN emprunt e
ON l.id_livre = e.id_livre
WHERE l.auteur = 'Alphonse Daudet';

-- EXERCICE : qui a emprunté "Une Vie" sur l'année 2011 ?

SELECT a.prenom, e.date_sortie
FROM abonne a
INNER JOIN emprunt e
ON a.id_abonne = e.id_abonne
INNER JOIN livre l
ON e.id_livre = l.id_livre
WHERE l.titre = 'Une vie' AND e.date_sortie LIKE '2011%';

-- EXERCICE : Afficher le nombre de livres empruntés par chaque abonné

SELECT a.prenom, COUNT(e.id_livre) AS nombre
FROM abonne a
INNER JOIN emprunt e
ON a.id_abonne = e.id_abonne
GROUP BY a.prenom;

-- EXERCICE : afficher qui a emprunté quels livres et à quelles dates de sortie ? (prénom, date_sortie, titre) : 

SELECT a.prenom, l.titre, e.date_sortie
FROM abonne a
INNER JOIN emprunt e
ON a.id_abonne = e.id_abonne
INNER JOIN livre l
ON e.id_livre = l.id_livre;
-- Ici pas de GROUP BY car il est normal que les prénoms sortent plusieurs fois (ils peuvent emprunter plusieurs livres)

-- Afficher les prénoms des abonnés avec les id_livres qu'ils ont emprunté

SELECT a.prenom, e.id_livre
FROM abonne a
INNER JOIN emprunt e
ON a.id_abonne = e.id_abonne;




-- **************************
-- Les jointures externes
-- **************************

-- Une jointure externe permet de faire des requêtes sans correspondance exigée entre les valeurs requêtées.

-- Ajoutez vous dans la table abonnés :
INSERT INTO abonne (prenom) VALUES ('Morgane');

-- Si on relance la dernière requête de jointure interne, nous n'apparaissons pas dans la liste car nous n'avons pas emprunté de livre (il n'y a pas de correspondance en face du prénom).
-- Pour y remédier, nous faisons une jointure externe :
SELECT a.prenom, e.id_livre
FROM abonne a
LEFT JOIN emprunt e
ON a.id_abonne = e.id_abonne;
-- La clause LEFT JOIN permet de rapatrier TOUTES les données dans la table considérée comme étant à gauche de l'instruction LEFT JOIN (donc abonne dans notre cas), sans correspondance exigée dans l'autre table (emprunt ici). 

-- Voici le cas avec un livre supprimé de la bibliothèque :
DELETE FROM livre WHERE id_livre = 100; -- Le livre Une Vie

-- On visualise les emprunts avec une jointure interne : 
SELECT emprunt.id_emprunt, livre.titre
FROM emprunt
INNER JOIN livre
ON emprunt.id_livre = livre.id_livre;
-- On ne voit pas dans cette requête le livre "Un Vie" qui a été supprimé.

-- On fait la même chose avec une jointure externe : 
SELECT emprunt.id_emprunt, livre.titre
FROM emprunt
LEFT JOIN livre
ON emprunt.id_livre = livre.id_livre;
-- Ici tous les emprunts sont affichés, y compris ceux pour lesquels les titres sont supprimés et remplacés par NULL.




-- **************************
-- UNION
-- **************************

-- Union permet de fusionner le résultat de deux requêtes dans la même liste de résultat.

-- EXEMPLE : si on désinscrit Guillaume (suppression du profil de la table abboné), on peut afficher à la fois tous les livres empruntés, y compris ceux par des lecteurs désinscrits(on affiche NULL à la place de Guillaume) et tous les abonnés, y compris ceux qui n'ont rien empruntés (on affiche NULL dans il_livre pour l'abonné 'Morgane').

-- Suppression du profil de Guillaume : 
DELETE FROM abonne WHERE id_abonne = 1;

-- Requête sur les livres empruntés avec UNION : 
(SELECT abonne.prenom, emprunt.id_livre FROM abonne LEFT JOIN emprunt ON abonne.id_abonne = emprunt.id_abonne)
UNION
(SELECT abonne.prenom, emprunt.id_livre FROM abonne RIGHT JOIN emprunt ON abonne.id_abonne = emprunt.id_abonne);


