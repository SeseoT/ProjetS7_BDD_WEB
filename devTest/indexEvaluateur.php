<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion
require('functions.php'); // Inclure le fichier de fonctions

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} else {

    $sql = "SELECT 
                e.numEvaluateur,
                e.specialite,
                ev.dateEvaluation,
                ev.note,
                ev.commentaire AS evaluation_commentaire,
                d.numDessin,
                d.classement,
                d.dateRemise,
                c.theme AS concours_theme,
                c.dateDebut AS concours_date_debut,
                c.dateFin AS concours_date_fin
            FROM 
                Evaluation ev
            JOIN 
                Dessin d ON ev.numDessin = d.numDessin
            JOIN 
                Concours c ON d.numConcours = c.numConcours
            JOIN 
                Evaluateur e ON ev.numEvaluateur = e.numEvaluateur
            WHERE 
                ev.numEvaluateur = :id_user
                AND c.etat = 'En Cours';";
    
    $results = requeteSQL($_SESSION['id_user'], $connexion, $sql, true);
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Concours</title>
    <link rel="stylesheet" href="style.css">
    <!-- Script JS -->
    <script src="script.js"></script>
</head>

<body>

    <!-- Header -->
    <!-- Menu de navigation -->
    <div class="menu">
        <a href="index.php">Accueil</a>
        <a href="concoursUser.php">Mes Concours</a>
        <a href="profile.php">Mon Profil</a>
        <a href="logout.php">Se déconnecter</a>
    </div>
    
    <div class="container center">
        <?php if (empty($results)): ?>
            <h1><?php echo '<p>Vous n\'avez pas d\'évaluations pour le concours en cours</p>'; ?></h1>
        <?php else: ?>
            <h1><?php echo '<p>Résultats du concours : ' . htmlspecialchars($results[0]['concours_theme']) . '</p>'; ?></h1>
    
            <table border="1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Numéro de l évaluateur</th>
                        <th>Spécialité</th>
                        <th>Date d évaluation</th>
                        <th>Note</th>
                        <th>Commentaire de l évaluation</th>
                        <th>Numéro du dessin</th>
                        <th>Classement</th>
                        <th>Date de remise</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $index => $row): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($row['numEvaluateur']); ?></td>
                            <td><?php echo htmlspecialchars($row['specialite']); ?></td>
                            <td><?php echo htmlspecialchars($row['dateEvaluation']); ?></td>
                            <td><?php echo htmlspecialchars($row['note']); ?></td>
                            <td><?php echo htmlspecialchars($row['evaluation_commentaire']); ?></td>
                            <td><?php echo htmlspecialchars($row['numDessin']); ?></td>
                            <td><?php echo htmlspecialchars($row['classement']); ?></td>
                            <td><?php echo htmlspecialchars($row['dateRemise']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>


</body>

</html>
