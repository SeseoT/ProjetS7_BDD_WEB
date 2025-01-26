<?php
session_start();
require("connect.php");
require('functions.php');

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} else {
    $sqlCompetiteurs = "SELECT 
        u.numUtilisateur AS numCompetiteur, 
        u.nom AS CompetiteurNom, 
        u.prenom AS CompetiteurPrenom
    FROM 
        Concours c
    JOIN CompetiteurParticipe cp ON c.numConcours = cp.numConcours
    JOIN Competiteur comp ON cp.numCompetiteur = comp.numCompetiteur
    JOIN Utilisateur u ON comp.numCompetiteur = u.numUtilisateur
    WHERE 
        c.etat = 'en cours'";

    $sqlEvaluateurs = "SELECT 
        u.numUtilisateur AS numEvaluateur,
        u.nom AS EvaluateurNom,
        u.prenom AS EvaluateurPrenom,
        e.specialite AS EvaluateurSpecialite
    FROM 
        Concours c
    JOIN EvaluateurJury ej ON c.numConcours = ej.numConcours
    JOIN Evaluateur e ON ej.numEvaluateur = e.numEvaluateur
    JOIN Utilisateur u ON e.numEvaluateur = u.numUtilisateur
    WHERE 
        c.etat = 'en cours'";

    $competiteurs = requeteSQLPresident($connexion, $sqlCompetiteurs, true);
    $evaluateurs = requeteSQLPresident($connexion, $sqlEvaluateurs, true);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Concours</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="menu">
        <a href="index.php">Accueil</a>
        <a href="concoursUser.php">Mes Concours</a>
        <a href="profile.php">Mon Profil</a>
        <a href="logout.php">Se déconnecter</a>
    </div>
    <div class="container center">
        <?php if (empty($competiteurs) && empty($evaluateurs)): ?>
            <h1>Aucun compétiteur ou évaluateur trouvé pour le concours en cours.</h1>
        <?php else: ?>
            <h1>Compétiteurs et Évaluateurs pour le concours en cours</h1>
    
            <?php if (!empty($competiteurs)): ?>
                <h2>Compétiteurs</h2>
                <table border="1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Numéro du compétiteur</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($competiteurs as $index => $row): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($row['numCompetiteur']); ?></td>
                                <td><?php echo htmlspecialchars($row['CompetiteurNom']); ?></td>
                                <td><?php echo htmlspecialchars($row['CompetiteurPrenom']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
    
            <?php if (!empty($evaluateurs)): ?>
                <h2>Évaluateurs</h2>
                <table border="1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Numéro de l évaluateur</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Spécialité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($evaluateurs as $index => $row): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($row['numEvaluateur']); ?></td>
                                <td><?php echo htmlspecialchars($row['EvaluateurNom']); ?></td>
                                <td><?php echo htmlspecialchars($row['EvaluateurPrenom']); ?></td>
                                <td><?php echo htmlspecialchars($row['EvaluateurSpecialite']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>