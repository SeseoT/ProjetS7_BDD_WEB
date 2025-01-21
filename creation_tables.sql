DROP TABLE IF EXISTS EvaluateurJury;
DROP TABLE IF EXISTS CompetiteurParticipe;
DROP TABLE IF EXISTS ClubParticipe;
DROP TABLE IF EXISTS Evaluation;
DROP TABLE IF EXISTS Dessin;
DROP TABLE IF EXISTS Concours;
DROP TABLE IF EXISTS Competiteur;
DROP TABLE IF EXISTS Evaluateur;
DROP TABLE IF EXISTS Directeur;
DROP TABLE IF EXISTS Administrateur;
DROP TABLE IF EXISTS President;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Club;



/*Creation des tables*/

CREATE TABLE Club (
    numClub INT PRIMARY KEY,
    nomClub VARCHAR(100) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    numTelephone VARCHAR(10),
    nombreAdherents INT,
    ville VARCHAR(100),
    departement VARCHAR(100),
    region VARCHAR(100)
);

CREATE TABLE Utilisateur (
    numUtilisateur INT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    login VARCHAR(50) UNIQUE NOT NULL,
    motDePasse VARCHAR(255) NOT NULL,
    numClub INT,
    FOREIGN KEY (numClub) REFERENCES Club(numClub) ON DELETE SET NULL
);

CREATE TABLE President (
    numPresident INT PRIMARY KEY,
    prime DECIMAL(10, 2),
    FOREIGN KEY (numPresident) REFERENCES Utilisateur(numUtilisateur) ON DELETE CASCADE
);

CREATE TABLE Administrateur (
    numAdministrateur INT PRIMARY KEY,
    dateDebut DATE NOT NULL,
    FOREIGN KEY (numAdministrateur) REFERENCES Utilisateur(numUtilisateur) ON DELETE CASCADE
);

CREATE TABLE Directeur (
    numDirecteur INT PRIMARY KEY,
    dateDebut DATE NOT NULL,
    numClub INT NOT NULL,
    FOREIGN KEY (numDirecteur) REFERENCES Utilisateur(numUtilisateur) ON DELETE CASCADE,
    FOREIGN KEY (numClub) REFERENCES Club(numClub) ON DELETE CASCADE
);


CREATE TABLE Competiteur (
    numCompetiteur INT PRIMARY KEY,
    datePremiereParticipation DATE,
    FOREIGN KEY (numCompetiteur) REFERENCES Utilisateur(numUtilisateur) ON DELETE CASCADE
);

CREATE TABLE Concours (
    numConcours INT PRIMARY KEY,
    theme VARCHAR(100) NOT NULL,
    dateDebut DATE NOT NULL,
    dateFin DATE NOT NULL,
    etat VARCHAR(50),
    descriptif VARCHAR(1000),
    numPresident INT NOT NULL,
    FOREIGN KEY (numPresident) REFERENCES President(numPresident) ON DELETE CASCADE,
    CHECK (DATEDIFF(dateFin, dateDebut) >= 1) /*-- Verifie que la date de fin est apres la date de debut*/
);

CREATE TABLE Dessin (
    numDessin INT PRIMARY KEY,
    commentaire TEXT,
    classement INT,
    dateRemise DATE NOT NULL,
    leDessin BLOB,
    numConcours INT NOT NULL,
    numCompetiteur INT NOT NULL,
    FOREIGN KEY (numConcours) REFERENCES Concours(numConcours) ON DELETE CASCADE,
    FOREIGN KEY (numCompetiteur) REFERENCES Competiteur(numCompetiteur) ON DELETE CASCADE
);


CREATE TABLE Evaluateur (
    numEvaluateur INT PRIMARY KEY,
    specialite VARCHAR(100),
    FOREIGN KEY (numEvaluateur) REFERENCES Utilisateur(numUtilisateur) ON DELETE CASCADE
);

CREATE TABLE Evaluation (
    dateEvaluation DATE NOT NULL,
    note DECIMAL(5, 2) NOT NULL,
    commentaire TEXT,
    numDessin INT NOT NULL,
    numEvaluateur INT NOT NULL,
    PRIMARY KEY (dateEvaluation, numDessin, numEvaluateur),
    FOREIGN KEY (numDessin) REFERENCES Dessin(numDessin) ON DELETE CASCADE,
    FOREIGN KEY (numEvaluateur) REFERENCES Evaluateur(numEvaluateur) ON DELETE CASCADE
);

CREATE TABLE ClubParticipe (
    numClub INT NOT NULL,
    numConcours INT NOT NULL,
    PRIMARY KEY (numClub, numConcours),
    FOREIGN KEY (numClub) REFERENCES Club(numClub) ON DELETE CASCADE,
    FOREIGN KEY (numConcours) REFERENCES Concours(numConcours) ON DELETE CASCADE
);

CREATE TABLE CompetiteurParticipe (
    numConcours INT NOT NULL,
    numCompetiteur INT NOT NULL,
    PRIMARY KEY (numConcours, numCompetiteur),
    FOREIGN KEY (numConcours) REFERENCES Concours(numConcours) ON DELETE CASCADE,
    FOREIGN KEY (numCompetiteur) REFERENCES Competiteur(numCompetiteur) ON DELETE CASCADE
);

CREATE TABLE EvaluateurJury (
    numConcours INT NOT NULL,
    numEvaluateur INT NOT NULL,
    PRIMARY KEY (numConcours, numEvaluateur),
    FOREIGN KEY (numConcours) REFERENCES Concours(numConcours) ON DELETE CASCADE,
    FOREIGN KEY (numEvaluateur) REFERENCES Evaluateur(numEvaluateur) ON DELETE CASCADE
);
