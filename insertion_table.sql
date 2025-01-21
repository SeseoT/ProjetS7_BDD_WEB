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
    (3, 'Peintres Marseillais', '15 Rue de l"Art, Marseille', '0491256789', 180, 'Marseille', 'Bouches-du-Rhone', 'Provence-Alpes-Cote d"Azur'),
    (4, 'Peintres Bordelais', '30 Rue du Tableau, Bordeaux', '0556123456', 160, 'Bordeaux', 'Gironde', 'Nouvelle-Aquitaine'),
    (5, 'Artistes Toulousains', '12 Avenue de l"Art, Toulouse', '0562556789', 140, 'Toulouse', 'Haute-Garonne', 'Occitanie'),
    (6, 'Createurs Nimois', '20 Rue des Couleurs, Nimes', '0466245789', 170, 'Nîmes', 'Gard', 'Occitanie'),
    (7, 'Artisans Strasbourgeois', '8 Place des Arts, Strasbourg', '0388245678', 130, 'Strasbourg', 'Bas-Rhin', 'Grand Est'),
    (8, 'Peintres Lillois', '5 Rue des Toiles, Lille', '0320246789', 110, 'Lille', 'Nord', 'Hauts-de-France'),
    (9, 'Sculpteurs Nantais', '18 Boulevard de la Sculpture, Nantes', '0240123456', 120, 'Nantes', 'Loire-Atlantique', 'Pays de la Loire'),
    (10, 'Artistes Rennais', '25 Avenue de la Palette, Rennes', '0299556677', 125, 'Rennes', 'Ille-et-Vilaine', 'Bretagne');

-- Table Utilisateur
INSERT INTO Utilisateur (numUtilisateur, nom, prenom, adresse, login, motDePasse, numClub)
VALUES
   --presidents
    (1, 'Martin', 'Claire', '5 Rue des Dessins, Lyon', 'cmartin', 'pass123', 1),
    (2, 'Dupont', 'Luc', '8 Avenue de l"Art, Paris', 'ldupont', 'pass456', 2),
    (3, 'Durand', 'Emma', '3 Boulevard des Peintres, Lyon', 'edurand', 'pass789', 3),
    (4, 'Leclerc', 'Julien', '10 Rue des Artistes, Paris', 'jleclerc', 'pass000', 4),
    (5, 'Dubois', 'Marc', '1 Rue du Tableau, Marseille', 'mdubois', 'pass111', 5),
    (6, 'Fournier', 'Sophie', '5 Avenue des Arts, Bordeaux', 'sfournier', 'pass222', 6),
    --admin
    (7, 'Lemoine', 'Pierre', '3 Rue des Peintres, Toulouse', 'plemoine', 'pass333', 0),
    --directeurs
    (8, 'Benoit', 'Thomas', '2 Avenue de l"Art, Nîmes', 'tbenoit', 'pass444', 6),
    (9, 'Morel', 'Alice', '12 Rue du Design, Lille', 'amorel', 'pass555', 7),
    (10, 'Roux', 'Antoine', '18 Rue des Sculpteurs, Lyon', 'aroux', 'pass666', 5),
    (11, 'Petit', 'Elodie', '25 Rue de l"Impression, Paris', 'epetit', 'pass777', 8),
    (12, 'Garcia', 'Hugo', '30 Avenue du Futur, Bordeaux', 'hgarcia', 'pass888', 7),
    (13, 'Bernard', 'Nina', '22 Rue des Arts, Marseille', 'nbernard', 'pass999', 7),
    (14, 'Girard', 'Paul', '15 Boulevard du Minimalisme, Lyon', 'pgirard', 'pass101', 9),
    (15, 'Andre', 'Chloe', '5 Place de la Lumière, Nîmes', 'candre', 'pass202', 10),
    (16, 'Lopez', 'Maxime', '9 Rue des Fresques, Paris', 'mlopez', 'pass303', 9),
    (17, 'Fernandez', 'Juliette', '20 Avenue du Dessin, Toulouse', 'jfernandez', 'pass404', 1),
    --evaluateurs
    (18, 'Mercier', 'Alexandre', '10 Rue du Graffiti, Marseille', 'amercier', 'pass505', 1),
    (19, 'Lambert', 'Lucie', '8 Avenue des Couleurs, Lille', 'llambert', 'pass606', 1),
    (20, 'Bonnet', 'Victor', '6 Rue du Futurisme, Paris', 'vbonnet', 'pass707', 1),
    (21, 'Dupuis', 'Sarah', '4 Boulevard de l"Art Moderne, Lyon', 'sdupuis', 'pass808', 2),
    (22, 'Schmitt', 'Quentin', '3 Rue des Lumières, Bordeaux', 'qschmitt', 'pass909', 2),
    (23, 'Colin', 'Amelie', '7 Avenue des Paysages, Toulouse', 'acolin', 'pass010', 2),
    (24, 'Barbier', 'Leo', '2 Rue des Céramiques, Nîmes', 'lbarbier', 'pass111', 3),
    (25, 'Gauthier', 'Marie', '11 Rue de la Sculpture, Lille', 'mgauthier', 'pass222', 3),
    (26, 'Chevalier', 'Louis', '16 Avenue des Abstraits, Marseille', 'lchevalier', 'pass333', 3),
    (27, 'Moulin', 'Manon', '19 Boulevard des Arts, Paris', 'mmoulin', 'pass444', 4),
    (28, 'Perez', 'Hugo', '14 Rue du Tableau Vivant, Lyon', 'hperez', 'pass555', 4),
    (29, 'Rey', 'Emma', '1 Rue de la Lumière, Toulouse', 'erey', 'pass666', 4),
    (30, 'Legran', 'Julie', '20 Avenue des Impressionnistes, Lille', 'jlegran', 'pass777', 5),
    (31, 'Vidal', 'Mathieu', '17 Rue du Design Urbain, Nîmes', 'mvidal', 'pass888', 5),
    (32, 'Roy', 'Camille', '13 Boulevard des Fresques, Bordeaux', 'croy', 'pass999', 5),
    (33, 'Perrin', 'Lucas', '22 Rue des Abstractions, Lyon', 'lperrin', 'pass010', 6),
    (34, 'Blanc', 'Elisa', '18 Avenue des Peintures, Paris', 'eblanc', 'pass111', 6),
    (35, 'Mallet', 'Arthur', '4 Boulevard de l"Art Urbain, Bordeaux', 'amallet', 'pass222', 6),
    (36, 'Noir', 'Justine', '12 Rue du Dessin Contemporain, Marseille', 'jnoir', 'pass333', 7),
    (37, 'Renaud', 'Adrien', '3 Avenue des Fresques, Lille', 'arenaud', 'pass444', 7),
    (38, 'Fabre', 'Louise', '7 Rue des Couleurs, Toulouse', 'lfabre', 'pass555', 7),
    (39, 'Perrot', 'Theo', '9 Place de l"Impression, Lyon', 'tperrot', 'pass666', 8),
    (40, 'Simon', 'Marie', '15 Avenue des Sculpteurs, Paris', 'msimon', 'pass777', 8),
    (41, 'Grange', 'Hugo', '11 Boulevard du Minimalisme, Bordeaux', 'hgrange', 'pass888', 8),
    (42, 'Brun', 'Alice', '10 Rue des Paysages, Marseille', 'abrun', 'pass999', 9),
    (43, 'Gaillard', 'Victor', '2 Rue du Graffiti, Lille', 'vgaillard', 'pass010', 9),
    (44, 'Chartier', 'Lucie', '6 Avenue des Céramiques, Lyon', 'lchartier', 'pass111', 9),
    (45, 'Olivier', 'Paul', '5 Place de l"Abstraction, Toulouse', 'polivier', 'pass222', 10),
    (46, 'Rossi', 'Chloe', '9 Boulevard de la Lumière, Marseille', 'crossi', 'pass333', 10),
    (47, 'Baron', 'Leo', '14 Rue des Arts Modernes, Paris', 'lbaron', 'pass444', 10),
    --competiteur
    --club 1
    (48, 'Paris', 'Emma', '19 Avenue des Designs, Lille', 'eparis', 'pass555', 1),
    (49, 'Rolland', 'Camille', '21 Boulevard des Peintures, Bordeaux', 'crolland', 'pass666', 1),
    (50, 'Renault', 'Antoine', '4 Rue des Sculptures Urbaines, Lyon', 'arenault', 'pass777', 1),
    (51, 'Guerin', 'Elodie', '16 Avenue de l"Art, Toulouse', 'eguerin', 'pass888', 1),
    (52, 'Collet', 'Maxime', '12 Rue des Tableaux, Marseille', 'mcollet', 'pass999', 1),
    (53, 'Millet', 'Alice', '8 Boulevard des Arts, Paris', 'amillet', 'pass010', 1),
    (54, 'Boucher', 'Hugo', '13 Avenue des Impressionnistes, Lyon', 'hboucher', 'pass111', 1),
    (55, 'Poulain', 'Manon', '5 Place des Lumières, Bordeaux', 'mpoulain', 'pass222', 1),
    (56, 'Lemoine', 'Theo', '7 Rue du Design Futuriste, Marseille', 'tlemoine', 'pass333', 1),
    (57, 'Levesque', 'Nina', '3 Avenue des Graffitis, Lille', 'nlevesque', 'pass444', 1),
  --club 2
    (58, 'Albert', 'Lucas', '22 Boulevard du Dessin Urbain, Toulouse', 'lalbert', 'pass555', 2),
    (59, 'Lemoal', 'Juliette', '20 Rue de l"Abstraction, Lyon', 'jlemoal', 'pass666', 2),
    (60, 'Clément', 'Victor', '17 Avenue des Paysages, Marseille', 'vclement', 'pass777', 2),
    (61, 'Briand', 'Sarah', '9 Place des Impressionnistes, Bordeaux', 'sbriand', 'pass888', 2),
    (62, 'Vallet', 'Emma', '11 Rue des Peintures Classiques, Paris', 'evallet', 'pass999', 2),
    (63, 'Fleury', 'Paul', '14 Avenue des Sculpteurs Modernes, Lille', 'pfleury', 'pass010', 2),
    (64, 'Verdier', 'Claire', '6 Rue du Design Minimaliste, Marseille', 'cverdier', 'pass111', 2),
    (65, 'Picard', 'Leo', '2 Boulevard des Arts Contemporains, Toulouse', 'lpicard', 'pass222', 2),
    (66, 'Renard', 'Chloe', '19 Rue des Céramiques Artisanales, Paris', 'crenard', 'pass333', 2),
    (67, 'Masson', 'Lucas', '3 Avenue des Graffitis Urbains, Lyon', 'lmasson', 'pass444', 2),
    --club 3
    (68, 'Marchand', 'Alice', '7 Rue des Couleurs Naturelles, Bordeaux', 'amarchand', 'pass555', 3),
    (69, 'Gillet', 'Antoine', '20 Boulevard des Dessins Urbains, Marseille', 'agillet', 'pass666', 3),
    (70, 'Cheval', 'Juliette', '10 Rue des Impressionnistes, Lille', 'jcheval', 'pass777', 3),
    (71, 'Legrand', 'Julie', '15 Rue des Couleurs, Toulouse', 'jlegrand', 'pass202', 3),
    (72, 'Moreau', 'Paul', '16 Rue des Fresques, Toulouse', 'pmoreau', 'pass303', 3),
    (73, 'Roussel', 'Louis', '17 Rue des Sculpteurs, Toulouse', 'lroussel', 'pass404', 3),
    (74, 'Lefevre', 'Arthur', '18 Rue des Artistes, Toulouse', 'alefevre', 'pass505', 3),
    (75, 'Laurent', 'Elodie', '19 Rue du Tableau, Toulouse', 'elaurent', 'pass606', 3),
    (76, 'Deschamps', 'Sophie', '23 Avenue de l"Art Nouveau, Paris', 'sdeschamps', 'pass707', 3),
    (77, 'Beaumont', 'Nicolas', '31 Rue des Ateliers, Lyon', 'nbeaumont', 'pass808', 3),
    --club 4
    (78, 'Delaunay', 'Charlotte', '27 Boulevard des Créateurs, Marseille', 'cdelaunay', 'pass909', 4),
    (79, 'Fontaine', 'Gabriel', '14 Place de l"Innovation, Bordeaux', 'gfontaine', 'pass121', 4),
    (80, 'Bouvier', 'Léa', '8 Rue de l"Expression, Toulouse', 'lbouvier', 'pass131', 4),
    (81, 'Lacroix', 'Mathis', '16 Avenue des Talents, Nantes', 'mlacroix', 'pass141', 4),
    (82, 'Germain', 'Inès', '22 Rue de l"Imagination, Lille', 'igermain', 'pass151', 4),
    (83, 'Hubert', 'Raphaël', '9 Boulevard des Créatifs, Strasbourg', 'rhubert', 'pass161', 4),
    (84, 'Dumont', 'Clara', '11 Avenue des Portraits, Montpellier', 'cdumont', 'pass171', 4),
    (85, 'Vasseur', 'Nathan', '25 Rue des Esquisses, Rennes', 'nvasseur', 'pass181', 4),
    (86, 'Lemaire', 'Eva', '33 Boulevard de l"Art Digital, Nice', 'elemaire', 'pass191', 4),
    (87, 'Boulay', 'Maxence', '18 Rue des Compositions, Reims', 'mboulay', 'pass201', 4),
    --club 5
    (88, 'Peltier', 'Jade', '20 Avenue des Perspectives, Grenoble', 'jpeltier', 'pass211', 5),
    (89, 'Bourgeois', 'Simon', '12 Rue des Installations, Dijon', 'sbourgeois', 'pass221', 5),
    (90, 'Jacquet', 'Maëlle', '28 Boulevard des Performances, Angers', 'mjacquet', 'pass231', 5),
    (91, 'Renard', 'Baptiste', '15 Avenue des Expositions, Le Mans', 'brenard', 'pass241', 5),
    (92, 'Guillot', 'Lina', '21 Rue des Arts Numériques, Nantes', 'lguillot', 'pass251', 5),
    (93, 'Meunier', 'Robin', '24 Avenue des Créations, Strasbourg', 'rmeunier', 'pass261', 5),
    (94, 'Tanguy', 'Flora', '29 Boulevard des Studios, Montpellier', 'ftanguy', 'pass271', 5),
    (95, 'Bertin', 'Oscar', '32 Rue de l"Art Contemporain, Nice', 'obertin', 'pass281', 5),
    (96, 'Seguin', 'Romane', '26 Avenue des Galeries, Reims', 'rseguin', 'pass291', 5),
    (97, 'Marty', 'Bastien', '17 Rue des Vernissages, Grenoble', 'bmarty', 'pass301', 5),
    --club 6
    (98, 'Leroy', 'Margaux', '13 Place des Expositions, Dijon', 'mleroy', 'pass311', 6),
    (99, 'Aubert', 'Théo', '8 Boulevard des Ateliers, Angers', 'taubert', 'pass321', 6),
    (100, 'Pelletier', 'Zoé', '19 Rue des Créateurs, Le Mans', 'zpelletier', 'pass331', 6),
    (101, 'Carpentier', 'Alex', '23 Avenue de l"Innovation, Caen', 'acarpentier', 'pass341', 6),
    (102, 'Navarro', 'Léonie', '28 Rue des Galeries, Orléans', 'lnavarro', 'pass351', 6),
    (103, 'Brunet', 'Samuel', '31 Boulevard des Artistes, Rouen', 'sbrunet', 'pass361', 6),
    (104, 'Wagner', 'Ambre', '16 Place de la Création, Metz', 'awagner', 'pass371', 6),
    (105, 'Lebrun', 'Valentin', '12 Rue des Studios, Perpignan', 'vlebrun', 'pass381', 6),
    (106, 'Duval', 'Carla', '25 Avenue des Arts Plastiques, Mulhouse', 'cduval', 'pass391', 6),
    (107, 'Salmon', 'Nolan', '30 Boulevard des Expositions, Brest', 'nsalmon', 'pass401', 6),
    --club 7
    (108, 'Tessier', 'Océane', '14 Rue de l"Art Urbain, Amiens', 'otessier', 'pass411', 7),
    (109, 'Perret', 'Dylan', '27 Avenue des Vernissages, Limoges', 'dperret', 'pass421', 7),
    (110, 'Michaud', 'Lilou', '22 Place des Créations, Bayonne', 'lmichaud', 'pass431', 7),
    (111, 'Lesage', 'Ethan', '18 Boulevard des Innovations, Besançon', 'elesage', 'pass441', 7),
    (112, 'Berthelot', 'Anaïs', '11 Rue des Performances, Poitiers', 'aberthelot', 'pass451', 7),
    (113, 'Vaillant', 'Enzo', '33 Avenue des Studios, Saint-Étienne', 'evaillant', 'pass461', 7),
    (114, 'Guilbert', 'Capucine', '15 Place de l"Art Digital, Toulon', 'cguilbert', 'pass471', 7),
    (115, 'Thibault', 'Axel', '20 Rue des Expositions, Pau', 'athibault', 'pass481', 7),
    (116, 'Reynaud', 'Lola', '24 Boulevard des Ateliers, Nancy', 'lreynaud', 'pass491', 7),
    (117, 'Cordier', 'Tom', '29 Avenue des Créateurs, Tours', 'tcordier', 'pass501', 7),
    --club 8
    (118, 'Godin', 'Maeva', '13 Rue de l"Art Moderne, Clermont-Ferrand', 'mgodin', 'pass511', 8),
    (119, 'Coulon', 'Nino', '28 Place des Galeries, Versailles', 'ncoulon', 'pass521', 8),
    (120, 'Pascal', 'Lena', '16 Boulevard des Innovations, Cannes', 'lpascal', 'pass531', 8),
    (121, 'Boutin', 'Mathéo', '21 Rue des Arts Visuels, La Rochelle', 'mboutin', 'pass541', 8),
    (122, 'Charpentier', 'Louna', '26 Avenue des Studios, Antibes', 'lcharpentier', 'pass551', 8),
    (123, 'Humbert', 'Timéo', '32 Place des Créations, Calais', 'thumbert', 'pass561', 8),
    (124, 'Guyot', 'Alicia', '17 Boulevard des Expositions, Colmar', 'aguyot', 'pass571', 8),
    (125, 'Chevallier', 'Martin', '23 Rue de l"Art Contemporain, Béziers', 'mchevallier', 'pass581', 8),
    (126, 'Bouvet', 'Célia', '19 Avenue des Vernissages, Dunkerque', 'cbouvet', 'pass591', 8),
    (127, 'Imbert', 'Lorenzo', '14 Place des Innovations, Arles', 'limbert', 'pass601', 8),
    --club 9
    (128, 'Marin', 'Jeanne', '30 Boulevard des Ateliers, Chartres', 'jmarin', 'pass611', 9),
    (129, 'Guichard', 'Kylian', '25 Rue des Performances, Niort', 'kguichard', 'pass621', 9),
    (130, 'Descamps', 'Camille', '11 Avenue des Studios, Chambéry', 'cdescamps', 'pass631', 9),
    (131, 'Gros', 'Romain', '27 Place de l"Art Digital, Vannes', 'rgros', 'pass641', 9),
    (132, 'Langlois', 'Yasmine', '22 Boulevard des Créations, Sète', 'ylanglois', 'pass651', 9),
    (133, 'Blanchet', 'Aaron', '18 Rue des Expositions, Beauvais', 'ablanchet', 'pass661', 9),
    (134, 'Valentin', 'Agathe', '33 Avenue des Galeries, Cholet', 'avalentin', 'pass671', 9),
    (135, 'Gregoire', 'Sacha', '15 Place des Innovations, Roanne', 'sgregoire', 'pass681', 9),
    (136, 'Bouchet', 'Louane', '20 Rue de l"Art Moderne, Blois', 'lbouchet', 'pass691', 9),
    (137, 'Sabatier', 'Noam', '24 Boulevard des Ateliers, Bastia', 'nsabatier', 'pass701', 9),
    --club 10
    (138, 'Delmas', 'Clémence', '29 Avenue des Studios, Mérignac', 'cdelmas', 'pass711', 10),
    (139, 'Caron', 'Loan', '13 Place des Créations, Saint-Malo', 'lcaron', 'pass721', 10),
    (140, 'Buisson', 'Pauline', '28 Rue des Performances, Belfort', 'pbuisson', 'pass731', 10),
    (141, 'Goujon', 'Rafael', '16 Boulevard de l"Art Digital, Albi', 'rgoujon', 'pass741', 10),
    (142, 'Pichon', 'Héloïse', '21 Avenue des Expositions, Lorient', 'hpichon', 'pass751', 10),
    (143, 'Grandjean', 'Marius', '26 Place des Innovations, Montauban', 'mgrandjean', 'pass761', 10),
    (144, 'Leblanc', 'Constance', '32 Rue des Galeries, Brive', 'cleblanc', 'pass771', 10),
    (145, 'Bazin', 'Tristan', '17 Boulevard des Ateliers, Carcassonne', 'tbazin', 'pass781', 10),
    (146, 'Lacombe', 'Apolline', '23 Avenue des Studios, Chalon', 'alacombe', 'pass791', 10),
    (147, 'Allard', 'César', '19 Place de l"Art Contemporain, Vienne', 'callard', 'pass801', 10),
--rab
    (148, 'Forestier', 'Lise', '14 Rue des Créations, Laval', 'lforestier', 'pass811', 3),
    (149, 'Perrier', 'Rémi', '30 Boulevard des Performances, Meaux', 'rperrier', 'pass821', 4),
    (150, 'Dufour', 'Félicie', '25 Avenue des Innovations, Quimper', 'fdufour', 'pass831', 5);

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
    (48, '2025-01-10'),
    (49, '2025-04-05'),
    (50, '2025-08-15'),
    (51, '2025-10-20'),
    (52, '2023-04-15'),
    (53, '2023-07-18'),
    (54, '2023-09-05'),
    (55, '2023-12-17'),
    (56, '2024-04-10'),
    (57, '2024-07-15'),
    (58, '2024-09-20'),
    (59, '2024-12-15'),
    (60, '2025-01-10'),
    (61, '2025-04-05'),
    (62, '2025-08-15'),
    (63, '2025-10-20'),
    (64, '2023-04-15'),
    (65, '2023-07-18'),
    (66, '2023-09-05'),
    (67, '2023-12-17'),
    (68, '2024-04-10'),
    (69, '2024-07-15'),
    (70, '2024-09-20'),
    (71, '2024-12-15'),
    (72, '2025-01-10'),
    (73, '2025-04-05'),
    (74, '2025-08-15'),
    (75, '2025-10-20'),
    (76, '2023-04-15'),
    (77, '2023-07-18'),
    (78, '2023-09-05'),
    (79, '2023-12-17'),
    (80, '2024-04-10'),
    (81, '2024-07-15'),
    (82, '2024-09-20'),
    (83, '2024-12-15'),
    (84, '2025-01-10'),
    (85, '2025-04-05'),
    (86, '2025-08-15'),
    (87, '2025-10-20'),
    (88, '2023-04-15'),
    (89, '2023-07-18'),
    (90, '2023-09-05'),
    (91, '2023-12-17'),
    (92, '2024-04-10'),
    (93, '2024-07-15'),
    (94, '2024-09-20'),
    (95, '2024-12-15'),
    (96, '2025-01-10'),
    (97, '2025-04-05'),
    (98, '2025-08-15'),
    (99, '2025-10-20'),
    (100, '2023-04-15'),
    (101, '2023-07-18'),
    (102, '2023-09-05'),
    (103, '2023-12-17'),
    (104, '2024-04-10'),
    (105, '2024-07-15'),
    (106, '2024-09-20'),
    (107, '2024-12-15'),
    (108, '2025-01-10'),
    (109, '2025-04-05'),
    (110, '2025-08-15'),
    (111, '2025-10-20'),
    (112, '2023-04-15'),
    (113, '2023-07-18'),
    (114, '2023-09-05'),
    (115, '2023-12-17'),
    (116, '2024-04-10'),
    (117, '2024-07-15'),
    (118, '2024-09-20'),
    (119, '2024-12-15'),
    (120, '2025-01-10'),
    (121, '2025-04-05'),
    (122, '2025-08-15'),
    (123, '2025-10-20'),
    (124, '2023-04-15'),
    (125, '2023-07-18'),
    (126, '2023-09-05'),
    (127, '2023-12-17'),
    (128, '2024-04-10'),
    (129, '2024-07-15'),
    (130, '2024-09-20'),
    (131, '2024-12-15'),
    (132, '2025-01-10'),
    (133, '2025-04-05'),
    (134, '2025-08-15'),
    (135, '2025-10-20'),
    (136, '2023-04-15'),
    (137, '2023-07-18'),
    (138, '2023-09-05'),
    (139, '2023-12-17'),
    (140, '2024-04-10'),
    (141, '2023-04-15'),
    (142, '2023-07-18'),
    (143, '2023-09-05'),
    (144, '2023-12-17'),
    (145, '2024-04-10');

-- Table Concours (Assurer qu'il y a 6 concours en tout, un pour chaque saison et chaque concours doit avoir 6 clubs)
INSERT INTO Concours (numConcours, theme, dateDebut, dateFin, etat, descriptif, numPresident)
VALUES
    (1, 'Paysages Naturels', '2023-04-15', '2023-04-25', 'Evalue', 'Un concours mettant en avant des représentations artistiques de paysages naturels à travers différents médiums.', 1),
    (2, 'Art Abstrait', '2023-07-18', '2023-07-28', 'Evalue', 'Exploration des formes et couleurs abstraites, offrant une liberté totale à l"imagination des artistes.', 2),
    (3, 'Peintures Classiques', '2023-09-05', '2023-09-15', 'Evalue', 'Un hommage aux techniques et styles traditionnels de la peinture classique.', 3),
    (4, 'Sculptures Modernes', '2023-12-17', '2023-12-27', 'Evalue', 'Une compétition mettant en lumière des œuvres sculpturales innovantes et modernes.', 4),
    (5, 'Arts Contemporains', '2024-04-10', '2024-04-20', 'Evalue', 'Un concours dédié aux créations contemporaines qui reflètent notre époque actuelle.', 2),
    (6, 'Art en Nature', '2024-07-15', '2024-07-25', 'Evalue', 'Des œuvres artistiques réalisées en harmonie avec la nature ou à partir d"éléments naturels.', 5),
    (7, 'Photographies Urbaines', '2024-09-20', '2024-09-30', 'Evalue', 'Mise en valeur de la vie urbaine et des paysages citadins à travers la photographie.', 6),
    (8, 'Graffiti et Street Art', '2024-12-15', '2024-12-25', 'En attente des résultats', 'Un concours célébrant l"art de la rue et la créativité des graffeurs.', 3),
    (9, 'Peintures Impressionnistes', '2025-01-10', '2025-01-20', 'En cours', 'Une invitation à reproduire la magie de la lumière et des couleurs propres à l"impressionnisme.', 4),
    (10, 'Design Minimaliste', '2025-04-05', '2025-04-15', 'Non commence', 'Exploration du design épuré et fonctionnel, centré sur la simplicité et l"essentiel.', 3),
    (11, 'Architecture Futuriste', '2025-08-15', '2025-08-25', 'Non commence', 'Un concours de conceptions architecturales visionnaires tournées vers l"avenir.', 6),
    (12, 'Céramiques Artisanales', '2025-10-20', '2025-10-30', 'Non commence', 'Un concours mettant en avant le savoir-faire artisanal et les créations en céramique.', 1);


-- Table Dessin (Un compétiteur     peut déposer jusqu'à 3 dessins par concours)
INSERT INTO Dessin (numDessin, commentaire, classement, dateRemise, leDessin, numConcours, numCompetiteur)
VALUES
    (1, 'Tres beau rendu des couleurs.', 1, '2024-01-15', NULL, 1, 50),
    (2, 'Design innovant.', 2, '2024-01-16', NULL, 1, 51),
    (3, 'Abstrait, mais captivant.', 1, '2024-01-17', NULL, 1, 52),
    (4, 'Exploration des formes géométriques.', 2, '2024-01-18', NULL, 1, 53);

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
    (6, 1),
    (7, 1),
    (8, 1),
    (1, 2),
    (2, 2),
    (3, 2),
    (4, 2),
    (7, 2),
    (8, 2),
    (10, 2),
    (2, 3),
    (3, 3),
    (4, 3),
    (5, 3),
    (6, 3),
    (8, 3),
    (10, 3),
    (1, 4),
    (3, 4),
    (4, 4),
    (5, 4),
    (6, 4),
    (8, 4),
    (1, 5),
    (2, 5),
    (3, 5),
    (5, 5),
    (6, 5),
    (7, 5),
    (8, 5),
    (10, 5),
    (1, 6),
    (2, 6),
    (4, 6),
    (6, 6),
    (7, 6),
    (10, 6),
    (1, 7),
    (2, 7),
    (3, 7),
    (4, 7),
    (8, 7),
    (9, 7),
    (10, 7),
    (1 ,8),
    (2, 8),
    (4, 8),
    (5, 8),
    (6, 8),
    (8, 8),
    (10, 8),
    (1, 9),
    (3, 9),
    (4, 9),
    (5, 9),
    (6, 9),
    (8, 9),
    (1, 10),
    (2, 10),
    (3, 10),
    (5, 10),
    (6, 10),
    (7, 10),
    (8, 10),
    (10, 10),
    (3, 11),
    (4, 11),
    (5, 11),
    (6, 11),
    (8, 11),
    (9, 11),
    (2, 12),
    (3, 12),
    (5, 12),
    (6, 12),
    (7, 12),
    (8, 12),
    (10, 12);

INSERT INTO CompetiteurParticipe (numConcours, numCompetiteur)
SELECT 1, numUtilisateur
FROM Utilisateur
WHERE numClub = 1
  AND numUtilisateur IN (SELECT numCompetiteur FROM Competiteur)
  AND numUtilisateur NOT IN (SELECT numCompetiteur FROM Competiteur)
    LIMIT 6;

-- Club 2
INSERT INTO CompetiteurParticipe (numConcours, numCompetiteur)
SELECT 1, numUtilisateur
FROM Utilisateur
WHERE numClub = 2
  AND numUtilisateur IN (SELECT numCompetiteur FROM Competiteur)
    LIMIT 6;

-- Club 3
INSERT INTO CompetiteurParticipe (numConcours, numCompetiteur)
SELECT 1, numUtilisateur
FROM Utilisateur
WHERE numClub = 3
  AND numUtilisateur IN (SELECT numCompetiteur FROM Competiteur)
    LIMIT 6;

-- Club 4
INSERT INTO CompetiteurParticipe (numConcours, numCompetiteur)
SELECT 1, numUtilisateur
FROM Utilisateur
WHERE numClub = 4
  AND numUtilisateur IN (SELECT numCompetiteur FROM Competiteur)
    LIMIT 6;

-- Club 6
INSERT INTO CompetiteurParticipe (numConcours, numCompetiteur)
SELECT 1, numUtilisateur
FROM Utilisateur
WHERE numClub = 6
  AND numUtilisateur IN (SELECT numCompetiteur FROM Competiteur)
    LIMIT 6;

-- Club 7
INSERT INTO CompetiteurParticipe (numConcours, numCompetiteur)
SELECT 1, numUtilisateur
FROM Utilisateur
WHERE numClub = 7
  AND numUtilisateur IN (SELECT numCompetiteur FROM Competiteur)
    LIMIT 6;

-- Club 8
INSERT INTO CompetiteurParticipe (numConcours, numCompetiteur)
SELECT 1, numUtilisateur
FROM Utilisateur
WHERE numClub = 8
  AND numUtilisateur IN (SELECT numCompetiteur FROM Competiteur)
    LIMIT 6;


-- Table EvaluateurJury (Un dessin doit être évalué par deux évaluateurs, un jury)
INSERT INTO EvaluateurJury (numConcours, numEvaluateur)
VALUES
    (1, 2),
    (1, 3),
    (2, 2),
    (2, 3);

