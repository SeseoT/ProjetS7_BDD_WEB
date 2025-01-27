<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion
require('functions.php'); // Inclure le fichier de fonctions

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} else {
    
    $result = requeteSQL($_SESSION['id_user'], $connexion, $sqlVerifierUserConcoursEnCours, false); //Requete SQL pour voir si l'utilisateur participe au concours en cours
    if (empty($result['theme'])) {
        $theme = "Erreur";
    } else {
        $theme = $result['theme'];
    }
    
    
    
    $sqlVerifierUserPresident = "SELECT * FROM President, Concours WHERE President.numPresident = :id_user AND Concours.etat = 'En Cours';";
    $result = requeteSQL($_SESSION['id_user'], $connexion, $sqlVerifierUserPresident, false);
    if (empty($result)) {
        $isPresident = false;  // L'utilisateur n'est pas Président
    } else {
        $isPresident = true;   // L'utilisateur est Président
    }
    
    
    
    
    $sqlVerifierUserCompetiteur = "SELECT * FROM Competiteur, Concours WHERE Competiteur.numCompetiteur = :id_user AND Concours.etat = 'En Cours';";
    $result = requeteSQL($_SESSION['id_user'], $connexion, $sqlVerifierUserCompetiteur, false);
    if (empty($result)) {
        $isCompetiteur = false;  // L'utilisateur n'est pas compétiteur
    } else {
        $isCompetiteur = true;   // L'utilisateur est compétiteur
    }
    
    
    $sqlVerifierUserEvaluateur = "SELECT * FROM Evaluateur, Concours WHERE Evaluateur.numEvaluateur = :id_user AND Concours.etat = 'En Cours';";
    // Appeler la fonction requeteSQL pour exécuter la requête
    $result = requeteSQL($_SESSION['id_user'], $connexion, $sqlVerifierUserEvaluateur, false);
    if (empty($result)) {
        $isEvaluateur = false;  // L'utilisateur n'est pas évaluateur
    } else {
        $isEvaluateur = true;   // L'utilisateur est évaluateur
    }

    
    try {
    $sql = "SELECT 
                COUNT(*) as nb_concours 
                FROM CompetiteurParticipe CP
                INNER JOIN Concours C ON CP.numConcours = C.numConcours
                WHERE CP.numCompetiteur = :id_user
                AND C.dateFin >= CURDATE()
                AND C.dateDebut <= DATE_ADD(CURDATE(), INTERVAL 365 DAY)
                AND C.etat = 'Non commence';";
            
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':id_user', $_SESSION['id_user']);
    $stmt->execute();
    $concours = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $nb_concours_proches = $concours['nb_concours'];
} catch (PDOException $e) {
    $nb_concours_proches = 0;
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
    
    <div class="container center">
          <?php if ($theme === "Erreur"): ?>
              <h1><?php echo '<p>Vous ne faites partie d\'aucun concours en cours</p>'; ?></h1>
          <?php else: ?>
               <h1><?php echo '<p>Vous participez au concours : ' . htmlspecialchars($theme) . '</p>'; ?></h1>
              
              <?php if ($isPresident): ?>
                  <?php echo '<p>Vous êtes Président du concours.</p>'; ?>
                  <?php echo '<a href="indexPresident.php" class="btn">Accéder à la gestion du concours</a>'; ?>
              <?php elseif ($isCompetiteur): ?>
                  <?php echo '<p>Vous êtes un compétiteur du concours.</p>'; ?>
                  <?php echo '<a href="indexCompetiteur.php" class="btn">Accéder à vos participations</a>'; ?>
              <?php elseif ($isEvaluateur): ?>
                  <?php echo '<p>Vous êtes un évaluateur du concours.</p>'; ?>
                  <?php echo '<a href="indexEvaluateur.php" class="btn">Accéder à vos évaluations</a>'; ?>
              <?php else: ?>
                  <?php echo '<p>Votre rôle n\'est pas défini dans le concours.</p>'; ?>
              <?php endif; ?>
          <?php endif; ?>
    </div>

    
    <?php if ($nb_concours_proches > 0): ?>
        <div class="container center">
            <span class="concours-alert"><?= $nb_concours_proches ?></span>
        </div>
    <?php endif; ?>
    
        
</body>

</html>
