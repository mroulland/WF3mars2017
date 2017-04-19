--**********************************
-- EXERCICES
--**********************************

-- 1. Qui conduit la voiture d'id_vehicule 503 ?

SELECT c.prenom
FROM conducteur c
INNER JOIN association_vehicule_conducteur a
ON c.id_conducteur = a.id_conducteur
WHERE id_vehicule = 503;

-- 2. Qui (prénom) conduit quel modele ?

SELECT c.prenom, v.modele
FROM conducteur c
INNER JOIN association_vehicule_conducteur a
ON c.id_conducteur = a.id_conducteur
INNER JOIN vehicule v
ON v.id_vehicule = a.id_vehicule
ORDER BY prenom;

-- 3. Insérez-vous dans la table conducteur. Puis affichez tous les conducteurs (même ceux qui n'ont pas de véhicule affectés) ainsi que les modèles de véhicules.
INSERT INTO conducteur (prenom, nom) VALUES ('Jawn', 'Black');

SELECT c.prenom, c.nom, v.marque, v.modele
FROM conducteur c
LEFT JOIN association_vehicule_conducteur a
ON c.id_conducteur = a.id_conducteur
LEFT JOIN vehicule v
ON v.id_vehicule = a.id_vehicule
ORDER BY prenom;


-- 4. Ajoutez l'enregistrement suivant : 
INSERT INTO vehicule (marque, modele, couleur, immatriculation) VALUES ('Renault', 'Espace', 'noir', 'ZE-123-RT');
-- Puis, afficher tous les modèles de véhicules y compris ceux qui n'ont pas de chauffeur affecté et le prénom des conducteurs.

SELECT c.prenom, c.nom, v.marque, v.modele
FROM conducteur c
RIGHT JOIN association_vehicule_conducteur a
ON c.id_conducteur = a.id_conducteur
RIGHT JOIN vehicule v
ON v.id_vehicule = a.id_vehicule
ORDER BY prenom;


-- 5. Afficher les prénoms des conducteurs (y compris ceux qui n'ont pas de véhicule) et de tous les modéles (y compris ceux qui n'ont pas de chauffeur).

(SELECT c.prenom, c.nom, v.marque, v.modele
FROM conducteur c
LEFT JOIN association_vehicule_conducteur a
ON c.id_conducteur = a.id_conducteur
LEFT JOIN vehicule v
ON v.id_vehicule = a.id_vehicule
ORDER BY prenom)

UNION

(SELECT c.prenom, c.nom, v.marque, v.modele
FROM conducteur c
RIGHT JOIN association_vehicule_conducteur a
ON c.id_conducteur = a.id_conducteur
RIGHT JOIN vehicule v
ON v.id_vehicule = a.id_vehicule
ORDER BY prenom);



