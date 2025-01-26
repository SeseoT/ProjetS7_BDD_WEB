<?php
session_start();
require("connect.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Vérifier si l'utilisateur est directeur
if (!isset($_SESSION['isDirecteur']) || $_SESSION['isDirecteur'] != 1) {
    echo "Vous n'êtes pas directeur. Erreur d'accès.";
    header("Location: indexUser.php");
    exit();
}

try {
    // Requête pour récupérer tous les concours non commencés
    $sqlConcours = "SELECT numConcours,dateDebut, theme FROM Concours WHERE etat = 'Non commence'";
    $stmtConcours = $connexion->prepare($sqlConcours);
    $stmtConcours->execute();
    $concours = $stmtConcours->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de récupération des concours : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sélection du Concours</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="menu">
        <a href="index.php">Accueil</a>
        <a href="profile.php">Mon Profil</a>
        <a href="logout.php">Déconnexion</a>
    </div>

    <h1>Concours Non Commencés</h1>

    <?php if (empty($concours)): ?>
        <div class="container">
            <p>"Aucun concours n'est actuellement prévu."</p>
        </div>
    <?php else: ?>

        <div class="liste-concours">
            <?php foreach ($concours as $concour): ?>
                <div class="container">

                    <a>
                    <?= htmlspecialchars($concour['theme']) ?>
                        du <?= date('d/m/Y', strtotime($concour['dateDebut'])) ?> au <?= date('d/m/Y', strtotime($concour['dateFin'])) ?>
                    </a>

                    <button type="submit" onclick="window.location.href='choisirParticipants.php?numConcours=<?= $concour['numConcours'] ?>'">
                      Voir le concours
                    </button>

                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>


    </div>
</body>
</html>