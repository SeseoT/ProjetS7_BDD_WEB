<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} else {
    try {
        $sql = "SELECT Concours.theme, COUNT(*) as concours_count
        FROM Competiteur, Concours, Utilisateur, CompetiteurParticipe
        WHERE numUtilisateur = :id_user 
        AND Utilisateur.numUtilisateur = Competiteur.numCompetiteur
        AND CompetiteurParticipe.numCompetiteur = Competiteur.numCompetiteur
        AND CompetiteurParticipe.numConcours = Concours.numConcours
        ";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id_user', $_SESSION['id_user']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erreur lors de la connexion : " . $e->getMessage());
    }
    if ($stmt->rowCount() > 0) {
        $theme = $result['theme'];
         $concoursCount = $result['concours_count'];
    } else {
        $theme = "Erreur";
        $concoursCount = "0";
        //echo "Nom d'utilisateur ou mot de passe incorrect";
    }
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
    
    <div class="header">
        <h1>Vous participez à <?= htmlspecialchars($concoursCount); ?> concours actuellement </h1>
    </div>

    
    <!-- Contenu principal -->
    <div class="container">
        <h2>Liste des concours</h2>
        <div class="user-info">
            <p><span class="user-data">Theme :</span> <?= htmlspecialchars($theme); ?></p>
        </div>
    </div>

</body>

</html>
