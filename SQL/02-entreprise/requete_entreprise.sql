-- ouvrir la console SQL sous XAMPP : 
--          cd c:\xampp\mysql\bin
--          mysql.exe -u root --password


-- Une ligne de commentaire en SQL débute par -- 
-- Les requêtes ne sont pas sensibles à la casse, mais une convention indique qu'il faut mettre les mots clés des requêtes en MAJUSCULES.


-- ********************************
-- Requêtes générales
-- ********************************
CREATE DATABASE enterprise; -- Crée une nouvelle base de données appelée "enterprise"

SHOW DATABASES; -- permet d'afficher les BDD disponibles

-- NE PAS SAISIR dans la console : 
DROP DATABASE entreprise; -- supprime la BDD entreprise (irréversible)

DROP table employes; -- Supprime la table employes

TRUNCATE employes;  -- vider la table employés de son contenu

-- On peut coller dans la console : 
USE enterprise;  -- se connecter à la BDD 

SHOW TABLES; -- Permet de lister les tables de la BDD en cours d'utilisation

DESC employes; -- observer la structure de la table ainsi que les champs (DESC pour describe)

-- ********************************
-- Requêtes de sélection
-- ********************************

SELECT nom, prenom FROM employes; -- "Affiche (sélectionne) les noms et prénoms de la table "employés" ; SELECT selectionne les champs indiqués, FROM là ou les tables utilisées.

SELECT service FROM employes; -- Affiche les services de l'entreprise

-- DISTINCT
-- On a vu dans la requête précédente que les services sont affichés plusieurs fois. Pour éliminer les doublons, on utilise DISTINCT : 
SELECT DISTINCT service FROM employes;

-- ALL ou *
-- On peut affocher toutes les informations issues d'une table avec une "*" (pour dire ALL) :
SELECT * FROM employes;  -- Affiche toute la table employe

-- clause WHERE
SELECT prenom, nom FROM employes WHERE service = 'informatique'; -- Affiche le prénom et le nom des employes du service informatique. Notez que le nom des champs ou des tables ne prennent pas de quotes, alors que les valeurs telles que 'informatique' prennent des quotes ou des guillemets. Cependant, s'il s'agit d'un chiffre, on ne lui met pas de quote.

-- BETWEEN 
SELECT nom, prenom, date_embauche FROM employes WHERE date_embauche BETWEEN '2006-01-01' AND '2010-12-31'; -- affiche les employés dont la date d'embauche se trouve entre 2006 et 2010

-- LIKE
SELECT prenom FROM employes WHERE prenom LIKE 's%';  -- Affiche le prénom des employés commençant par s. Le signe % est un joker qui remplace les autres caractères. 
SELECT prenom FROM employes WHERE prenom LIKE '%-%'; --affiche les prénoms qui continennt un tiret. LIKE est utilisé en autre pour les formualaires de recherche sur les sites.

-- Opérateurs de comparaisons : 
SELECT prenom, nom, service FROM employes WHERE service != 'informatique'; -- affiche les prénoms et noms des employes n'étant pas du service informatique

--              =
--              <
--              >
--              <=
--              >=
--              !=  ou encore  <> pour différent de

-- ORDER BY pour faire des tris : 
SELECT nom, prenom, service, salaire FROM employes ORDER BY salaire; -- Affiche les employés par salaire en ordre croissant par défaut. 

SELECT nom, prenom, service, salaire FROM employes ORDER BY salaire ASC, prenom DESC;  -- ASC pour un tri ascendant, DESC pour un tri descendant. Ici, on trie les salaires dans un ordre croissant puis à salaire identique, les prénoms par ordre décroissant.

-- LIMIT
SELECT nom, prenom, salaire FROM employes ORDER BY salaire DESC LIMIT 0,1; -- Affiche l'employé ayant le salaire le plus élevé : on trie d'abord les salaires par ordre décroissant (pour avoir le plus élevé en premier), on on limite le résultat au premier enregistrement avec LIMIT 0,1. Le 0 signifie le point de départ de LIMIT, et le 1 signifie prendre 1 enregistrement. On utilise LIMIT dans la pagination sur les sites.

-- L'alias avec AS
SELECT nom, prenom, salaire * 12 AS salaire_annuel FROM employes; -- Addiche le salaire sur 12 mois des employes. salaire_annuel est un alias qui stoke la valeur de ce qui précède. 

-- SUM
SELECT SUM(salaire * 12) FROM employes; -- Affiche le salaire total annuel de tous les employess. SUM permet d'additionner les valeurs de champs différents. 

-- MIN et MAX :
SELECT MIN(salaire) FROM employes; -- Affiche le salaire le plus bas 
SELECT MAX(salaire) FROM employes; -- Affiche le salaire le plus haut

SELECT prenom, MIN(salaire) FROM employes; -- Ne donne pas le résultat attendu, car affiche le premier prénom rencontré dans la table (Jean Pierre). Il faut pour répondre à cette question utiliser ORDER BY et LIMIT comme au dessus :
SELECT prenom, salaire, salaire FROM employes ORDER BY salaire ASC LIMIT 0,1;

-- AVG (average)
SELECT AVG (salaire) FROM employes; -- affiche le salaire moyen de l'entreprise

-- ROUND 
SELECT ROUND (AVG(salaire), 1) FROM employes; -- affiche le salaire moyen arrondi à 1chiffre après la vigule

-- COUNT
SELECT COUNT(id_employes) FROM employes WHERE sexe = 'f'; -- Affiche le nombre d'employés féminins

-- IN
SELECT prenom, service FROM employes WHERE service IN('comptabilite', 'informatique'); -- Afffiche les employes appartenant à la comptabilité ou à l'informatique.

-- NOT IN
SELECT prenom, service FROM employes WHERE service NOT IN ('comptabilite', 'informatique'); -- Afffiche les employes n'appartenant pas à la comptabilité ou à l'informatique.

-- AND et OR
SELECT prenom, service, salaire FROM employes WHERE service = 'commercial' AND salaire <= 2000; -- Affiche le prénom des commerciaux dont le salaire est inférieur ou égal à 2000.

SELECT prenom, service, salaire FROM employes WHERE (service = 'production' AND salaire = 1900) OR salaire = 2300; -- affiche les employes du service production dont le salaire est de 1900 ou les autres services qui gagne 2300.

-- GROUP BY
SELECT service, COUNT(id_employes) AS nombre FROM employes GROUP BY service; -- affiche le nombre d'employes PAR service. GROUP BY dsitribue les résultats du comptage par les services correspondants

-- GROUP BY ... HAVING 
SELECT sercice, COUNT(id_employes) AS nombre FROM employes GROUP BY service HAVING nombre > 1; -- Affiche les services où il y a plus d'un employé. HAVING remplace WHERE dans uin GROUP BY


-- ********************************
-- Requêtes de sélection
-- ********************************

SELECT * FROM employes; -- on observe la table avant de la modifier

INSERT INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES(8058, 'Alexis', 'Richie', 'm', 'informatique', '2011-11-28', '1800'); -- insertion d'un employé. Notez que l'ordre des champs énoncés entre les deux paires de parenthèses doit être le même pour que les valeurs correspondent. 

-- Une requête sans préciser les champs concernés : 
INSERT INTO employes VALUES(8060, 'test', 'test', 'm', 'test', '2012-12-28', '1800', 'valeur en trop'); -- Insertion d'un employé sans préciser la liste des champs si et seulement si le nombre et l'ordre des valeurs attendues sont respectées => ici erreur car il y a une valeur en trop ! 

-- ********************************
-- Requêtes de modification
-- ********************************

-- UPDATE 
UPDATE employes SET salaire = 1870 WHERE nom = 'cottet',  -- modifie le salaire de l'employé de nom 'Cottet'

UPDATE employes SET salaire = 1871 WHERE id_employes = 699; -- Il est recommandé de faire des modifications de données par les id car ils sont uniques (contrairement aux noms), cela évite d'updater plusieurs enregistrements à la fois

UPDATE employes SET salaire = 1872, service = "autre" WHERE id_employes = 699; -- On modifie deux valeurs dans la même requête

-- A ne pas faire (sauf cas contraire) : un UPDATE sans clause WHERE :
UPDATE employes SET salaire = 1870; -- ici les salaires de TOUS les employes passent à 1870


-- REPLACE
REPLACE INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (2000, 'test', 'test', 'm', 'marketing', '2010-07-05', 2600);
-- l'id_employes 2000 n'existant pas, REPLACE se comporte comme un INSERT

REPLACE INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (2000, 'test2', 'test2', 'm', 'marketing', '2010-07-05', 2601);
-- l'id_employes existe, le REPLACE se comporte donc comme un UPDATE'

-- ********************************
-- Requêtes de modification
-- ********************************

-- DELETE 
DELETE FROM employes WHERE id_employes = 900; -- Suppression de l'employé dont l'id est 900

DELETE FROM employes WHERE service = 'informatique' AND id_employes != 802; -- Supprime tous les informaticiens sauf le 1 dont l'id est 802

DELETE FROM employes WHERE id_employes = 388 OR id_employes = 990; -- Supprime deux employés qui n'ont pas de points commun. Il s'agit d'un OR et non pas d'un AND car un employé ne peut pas avoir 2 id_employes différents.

-- A ne pas faire : un DELETE sans clause WHERE
DELETE FROM employes; -- revient à faire un TRUNCATE de table qui est irréversible

-- ********************************
-- Requêtes de modification
-- ********************************

-- 1. Afficher le service de l'employé 547
SELECT service FROM employes WHERE id_employes = 547  
-- => "Commercial"

-- 2. Afficher la date d'embauche d'Amandine
SELECT date_embauche FROM employes WHERE prenom = 'Amandine';
-- => 2010-01-23

-- 3. Afficher le nombre de commerciaux
SELECT COUNT(id_employes) FROM employes WHERE service = 'commercial';
-- => 5

-- 4. Afficher le coût des commerciaux sur 1 annuel
SELECT SUM(salaire*12) FROM employes WHERE service = 'commercial';
-- => 156 600

-- 5. Afficher le salaire moyen par service
SELECT service, AVG(salaire) FROM employes GROUP BY service;

-- 6. Afficher le nombre de recrutements sur l'année 2010 (3 syntaxes possibles) 
SELECT COUNT(id_employes) FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND '2010-12-31';
SELECT COUNT(id_employes) FROM employes WHERE date_embauche LIKE '2010%';
-- => 3

-- 7. Augmenter le salaire de chaque employé de 100
UPDATE employes SET salaire = salaire + 100;
 
-- 8. Afficher le nombre de services différents
SELECT COUNT(DISTINCT(service))  FROM employes;
-- => 10

-- 9. Afficher le nombre d'employés par service
SELECT service, COUNT(id_employes) AS employes FROM employes GROUP BY service;

-- 10. Afficher les infos de l'employé du service commercial ayant le salaire le plus élevé
SELECT nom, prenom, service, salaire FROM employes WHERE service = 'commercial' ORDER BY salaire DESC LIMIT 0,1 ;
-- => Winter Thomas, 3650

-- 11. Afficher l'employé ayant été embaucher en dernier
SELECT id_employes, nom, prénom, salaire FROM employes ORDER BY date_embauche DESC LIMIT 1;





