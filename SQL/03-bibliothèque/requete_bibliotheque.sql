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
SELECT COUNT(titres) FROM livre WHERE auteur = "Alexandre Dumas";

-- 7. Quel id_livre est le plus emprunté ? 
SELECT id_emprunt, COUNT(id_livre) FROM emprunt GROUP BY livre;

-- 8. Quel id_abonne emprunte le plus de livres ?


