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
                d.numDessin,
                d.classement,
                d.dateRemise,
                c.theme AS concours_theme,
                c.dateDebut AS concours_date_debut,
                c.dateFin AS concours_date_fin
            FROM 
                Dessin d
            JOIN 
                Concours c ON d.numConcours = c.numConcours
            WHERE 
                d.numCompetiteur = :id_user
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
            <h1><?php echo '<p>Vous n\'avez pas de dessins soumis pour le concours en cours.</p>'; ?></h1>
        <?php else: ?>
            <h1><?php echo '<p>Résultats du concours : ' . htmlspecialchars($results[0]['concours_theme']) . '</p>'; ?></h1>
        
            <table border="1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Numéro du dessin</th>
                        <th>Classement</th>
                        <th>Date de remise</th>
                        <th>Thème du concours</th>
                        <th>Date de début du concours</th>
                        <th>Date de fin du concours</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $index => $row): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($row['numDessin']); ?></td>
                            <td><?php echo htmlspecialchars($row['classement']); ?></td>
                            <td><?php echo htmlspecialchars($row['dateRemise']); ?></td>
                            <td><?php echo htmlspecialchars($row['concours_theme']); ?></td>
                            <td><?php echo htmlspecialchars($row['concours_date_debut']); ?></td>
                            <td><?php echo htmlspecialchars($row['concours_date_fin']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>



</body>

</html>
