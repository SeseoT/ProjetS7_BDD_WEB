-- Vidage des tables dans l'ordre inverse des dépendances
DELETE FROM EvaluateurJury;
DELETE FROM CompetiteurParticipe;
DELETE FROM ClubParticipe;
DELETE FROM Evaluation;
DELETE FROM Dessin;
DELETE FROM Concours;
DELETE FROM Competiteur;
DELETE FROM Evaluateur;
DELETE FROM Directeur;
DELETE FROM Administrateur;
DELETE FROM President;
DELETE FROM Utilisateur;
DELETE FROM Club;

-- Réinitialisation des données

-- Table Club (6 clubs pour respecter la contrainte de participation à un concours)
INSERT INTO Club (numClub, nomClub, adresse, numTelephone, nombreAdherents, ville, departement, region)
VALUES
(1, 'Artistes Lyonnais', '10 Rue de la Peinture, Lyon', '0478561234', 150, 'Lyon', 'Rhone', 'Auvergne-Rhone-Alpes'),
(2, 'Createurs Parisiens', '22 Avenue des Arts, Paris', '0156789123', 200, 'Paris', 'Ile-de-France', 'Ile-de-France'),
(3, 'Peintres Marseillais', '15 Rue de l\'Art, Marseille', '0491256789', 180, 'Marseille', 'Bouches-du-Rhone', 'Provence-Alpes-Cote d\'Azur'),
(4, 'Peintres Bordelais', '30 Rue du Tableau, Bordeaux', '0556123456', 160, 'Bordeaux', 'Gironde', 'Nouvelle-Aquitaine'),
(5, 'Artistes Toulousains', '12 Avenue de l\'Art, Toulouse', '0562556789', 140, 'Toulouse', 'Haute-Garonne', 'Occitanie'),
(6, 'Createurs Nimois', '20 Rue des Couleurs, Nimes', '0466245789', 170, 'Nîmes', 'Gard', 'Occitanie');

-- Table Utilisateur
INSERT INTO Utilisateur (numUtilisateur, nom, prenom, adresse, login, motDePasse, numClub)
VALUES
(1, 'Martin', 'Claire', '5 Rue des Dessins, Lyon', 'cmartin', 'pass123', 1),
(2, 'Dupont', 'Luc', '8 Avenue de l\'Art, Paris', 'ldupont', 'pass456', 2),
(3, 'Durand', 'Emma', '3 Boulevard des Peintres, Lyon', 'edurand', 'pass789', 1),
(4, 'Leclerc', 'Julien', '10 Rue des Artistes, Paris', 'jleclerc', 'pass000', 2),
(5, 'Dubois', 'Marc', '1 Rue du Tableau, Marseille', 'mdubois', 'pass111', 3),
(6, 'Fournier', 'Sophie', '5 Avenue des Arts, Bordeaux', 'sfournier', 'pass222', 4),
(7, 'Lemoine', 'Pierre', '3 Rue des Peintres, Toulouse', 'plemoine', 'pass333', 5),
(8, 'Benoit', 'Thomas', '2 Avenue de l\'Art, Nîmes', 'tbenoit', 'pass444', 6);
(9, ''Morel'', ''Alice'', ''12 Rue du Design, Lille'', ''amorel'', ''pass555'', 7),
(10, ''Roux'', ''Antoine'', ''18 Rue des Sculpteurs, Lyon'', ''aroux'', ''pass666'', 5),
(11, ''Petit'', ''Elodie'', ''25 Rue de l\''Impression, Paris'', ''epetit'', ''pass777'', 8),
(12, ''Garcia'', ''Hugo'', ''30 Avenue du Futur, Bordeaux'', ''hgarcia'', ''pass888'', 7),
(13, ''Bernard'', ''Nina'', ''22 Rue des Arts, Marseille'', ''nbernard'', ''pass999'', 7),
(14, ''Girard'', ''Paul'', ''15 Boulevard du Minimalisme, Lyon'', ''pgirard'', ''pass101'', 9),
(15, ''Andre'', ''Chloe'', ''5 Place de la Lumière, Nîmes'', ''candre'', ''pass202'', 10),
(16, ''Lopez'', ''Maxime'', ''9 Rue des Fresques, Paris'', ''mlopez'', ''pass303'', 9),
(17, ''Fernandez'', ''Juliette'', ''20 Avenue du Dessin, Toulouse'', ''jfernandez'', ''pass404'', 1),
(18, ''Mercier'', ''Alexandre'', ''10 Rue du Graffiti, Marseille'', ''amercier'', ''pass505'', 8),
(19, ''Lambert'', ''Lucie'', ''8 Avenue des Couleurs, Lille'', ''llambert'', ''pass606'', 2),
(20, ''Bonnet'', ''Victor'', ''6 Rue du Futurisme, Paris'', ''vbonnet'', ''pass707'', 3),
(21, ''Dupuis'', ''Sarah'', ''4 Boulevard de l\''Art Moderne, Lyon'', ''sdupuis'', ''pass808'', 4),
(22, ''Schmitt'', ''Quentin'', ''3 Rue des Lumières, Bordeaux'', ''qschmitt'', ''pass909'', 4),
(23, ''Colin'', ''Amelie'', ''7 Avenue des Paysages, Toulouse'', ''acolin'', ''pass010'', 3),
(24, ''Barbier'', ''Leo'', ''2 Rue des Céramiques, Nîmes'', ''lbarbier'', ''pass111'', 10),
(25, ''Gauthier'', ''Marie'', ''11 Rue de la Sculpture, Lille'', ''mgauthier'', ''pass222'', 6),
(26, ''Chevalier'', ''Louis'', ''16 Avenue des Abstraits, Marseille'', ''lchevalier'', ''pass333'', 6),
(27, ''Moulin'', ''Manon'', ''19 Boulevard des Arts, Paris'', ''mmoulin'', ''pass444'', 1),
(28, ''Perez'', ''Hugo'', ''14 Rue du Tableau Vivant, Lyon'', ''hperez'', ''pass555'', 9),
(29, ''Rey'', ''Emma'', ''1 Rue de la Lumière, Toulouse'', ''erey'', ''pass666'', 3),
(30, ''Legrand'', ''Julie'', ''20 Avenue des Impressionnistes, Lille'', ''jlegrand'', ''pass777'', 4),
(31, ''Vidal'', ''Mathieu'', ''17 Rue du Design Urbain, Nîmes'', ''mvidal'', ''pass888'', 5),
(32, ''Roy'', ''Camille'', ''13 Boulevard des Fresques, Bordeaux'', ''croy'', ''pass999'', 6);

-- Table President (Un président pour chaque concours)
INSERT INTO President (numPresident, prime)
VALUES
(1, 3200.00),
(2, 3000.00),
(3, 1500.00),
(4, 5500.00),
(5, 2000.00),
(6, 3000.00);


-- Table Administrateur
INSERT INTO Administrateur (numAdministrateur, dateDebut)
VALUES
(7, '2023-01-01');

-- Table Directeur
INSERT INTO Directeur (numDirecteur, dateDebut, numClub)
VALUES
    (8, '2021-03-15', 1),
    (9, '2020-06-10', 2),
    (10, '2022-05-01', 3),
    (11, '2019-11-20', 4),
    (12, '2023-01-05', 5),
    (13, '2022-09-12', 6),
    (14, '2021-07-18', 7),
    (15, '2020-04-22', 8),
    (16, '2023-03-10', 9),
    (17, '2022-12-01', 10);

-- Table Competiteur (Les compétiteurs sont répartis dans différents concours)
INSERT INTO Competiteur (numCompetiteur, datePremiereParticipation)
VALUES
(1, '2020-06-15'),
(2, '2021-07-10'),
(3, '2022-08-12'),
(4, '2022-11-14'),
(5, '2023-02-18'),
(6, '2023-04-21'),
(7, '2023-05-30'),
(8, '2023-07-09');

-- Table Concours (Assurer qu'il y a 6 concours en tout, un pour chaque saison et chaque concours doit avoir 6 clubs)
INSERT INTO Concours (numConcours, theme, dateDebut, dateFin, etat, descriptif, numPresident)
VALUES
(1, 'Paysages Naturels', '2023-04-15', '2023-04-25', 'Evalue', 'Un concours mettant en avant des représentations artistiques de paysages naturels à travers différents médiums.', 1),
(2, 'Art Abstrait', '2023-07-18', '2023-07-28', 'Evalue', 'Exploration des formes et couleurs abstraites, offrant une liberté totale à l\'imagination des artistes.', 2),
(3, 'Peintures Classiques', '2023-09-05', '2023-09-15', 'Evalue', 'Un hommage aux techniques et styles traditionnels de la peinture classique.', 3),
(4, 'Sculptures Modernes', '2023-12-17', '2023-12-27', 'Evalue', 'Une compétition mettant en lumière des œuvres sculpturales innovantes et modernes.', 4),
(5, 'Arts Contemporains', '2024-04-10', '2024-04-20', 'Evalue', 'Un concours dédié aux créations contemporaines qui reflètent notre époque actuelle.', 2),
(6, 'Art en Nature', '2024-07-15', '2024-07-25', 'Evalue', 'Des œuvres artistiques réalisées en harmonie avec la nature ou à partir d\'éléments naturels.', 5),
(7, 'Photographies Urbaines', '2024-09-20', '2024-09-30', 'Evalue', 'Mise en valeur de la vie urbaine et des paysages citadins à travers la photographie.', 6),
(8, 'Graffiti et Street Art', '2024-12-15', '2024-12-25', 'En attente des résultats', 'Un concours célébrant l\'art de la rue et la créativité des graffeurs.', 3),
(9, 'Peintures Impressionnistes', '2025-01-10', '2025-01-20', 'En cours', 'Une invitation à reproduire la magie de la lumière et des couleurs propres à l\'impressionnisme.', 4),
(10, 'Design Minimaliste', '2025-04-05', '2025-04-15', 'Non commence', 'Exploration du design épuré et fonctionnel, centré sur la simplicité et l\'essentiel.', 3),
(11, 'Architecture Futuriste', '2025-08-15', '2025-08-25', 'Non commence', 'Un concours de conceptions architecturales visionnaires tournées vers l\'avenir.', 6),
(12, 'Céramiques Artisanales', '2025-10-20', '2025-10-30', 'Non commence', 'Un concours mettant en avant le savoir-faire artisanal et les créations en céramique.', 1);





-- Table Dessin (Un compétiteur     peut déposer jusqu'à 3 dessins par concours)
INSERT INTO Dessin (numDessin, commentaire, classement, dateRemise, leDessin, numConcours, numCompetiteur)
VALUES
(1, 'Tres beau rendu des couleurs.', 1, '2024-01-15', NULL, 1, 1),
(2, 'Design innovant.', 2, '2024-01-16', NULL, 1, 1),
(3, 'Abstrait, mais captivant.', 1, '2024-01-17', NULL, 1, 2),
(4, 'Exploration des formes géométriques.', 2, '2024-01-18', NULL, 1, 2);

-- Table Evaluateur (Assurer qu'il y a 3 évaluateurs par concours)
INSERT INTO Evaluateur (numEvaluateur, specialite)
VALUES
(2, 'Paysages'),
(3, 'Abstrait'),
(4, 'Contemporain');

-- Table Evaluation (Deux évaluateurs pour chaque dessin)
INSERT INTO Evaluation (dateEvaluation, note, commentaire, numDessin, numEvaluateur)
VALUES
('2024-01-15', 9.5, 'Excellent.', 1, 2),
('2024-01-15', 8.0, 'Bien realise.', 1, 3),
('2024-01-16', 8.5, 'Tres bon effort.', 2, 2),
('2024-01-16', 9.0, 'Belle technique.', 2, 3);

-- Table ClubParticipe (Assurer qu'il y a au moins 6 clubs dans chaque concours)
INSERT INTO ClubParticipe (numClub, numConcours)
VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1);

-- Table CompetiteurParticipe (Un compétiteur peut participer à un concours)
INSERT INTO CompetiteurParticipe (numConcours, numCompetiteur)
VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6);

-- Table EvaluateurJury (Un dessin doit être évalué par deux évaluateurs, un jury)
INSERT INTO EvaluateurJury (numConcours, numEvaluateur)
VALUES
(1, 2),
(1, 3),
(2, 2),
(2, 3);

