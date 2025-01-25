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

// Vérifier la présence du numéro de concours
if (!isset($_GET['numConcours'])) {
    header("Location: listeConcours.php");
    exit();
}

try{

    $sqlclub = "SELECT numClub FROM Utilisateur WHERE numUtilisateur = :id";
    $stmtclub = $connexion->prepare($sqlclub);
    $stmtclub->bindParam(':id', $_SESSION['id_user'], PDO::PARAM_INT);
    $stmtclub->execute();
    $numClub = $stmtclub->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){die("Erreur de récupération : " . $e->getMessage());}


try {
          // Récupérer les informations du concours
    $sqlConcours = "SELECT theme FROM Concours WHERE numConcours = :numConcours";
    $stmtConcours = $connexion->prepare($sqlConcours);
    $stmtConcours->bindParam(':numConcours', $_GET['numConcours'], PDO::PARAM_INT);
    $stmtConcours->execute();
    $concours = $stmtConcours->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){die("Erreur de récupération : " . $e->getMessage());}


try{
    // competiteurs
    $sqlCompetiteur = "SELECT numUtilisateur, prenom, nom
                        FROM Utilisateur
                        WHERE numUtilisateur IN (SELECT numCompetiteur FROM CompetiteurParticipe WHERE numConcours = :numConcours)
                        AND numUtilisateur IN (SELECT numCompetiteur FROM Competiteur)
                        AND Utilisateur.numClub = :club";

    $stmtCompetiteur = $connexion->prepare($sqlCompetiteur);
    $stmtCompetiteur->bindParam(':numConcours', $_GET['numConcours'], PDO::PARAM_INT);
    $stmtCompetiteur->bindParam(':club', $numClub['numClub'], PDO::PARAM_INT);
    $stmtCompetiteur->execute();
    $competiteurs = $stmtCompetiteur->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de récupération : " . $e->getMessage());
}

try{
    // evaluateurs
    $sqlEvaluateurs = "SELECT numUtilisateur, prenom, nom
                        FROM Utilisateur
                        WHERE numUtilisateur IN (SELECT numEvaluateur FROM EvaluateurJury WHERE numConcours = :numConcours)
                        AND numUtilisateur IN (SELECT numEvaluateur FROM Evaluateur)
                        AND Utilisateur.numClub = :club";

    $stmtEvaluateurs = $connexion->prepare($sqlEvaluateurs);
    $stmtEvaluateurs->bindParam(':numConcours', $_GET['numConcours'], PDO::PARAM_INT);
    $stmtEvaluateurs->bindParam(':club', $numClub['numClub'], PDO::PARAM_INT);
    $stmtEvaluateurs->execute();
    $evaluateurs = $stmtEvaluateurs->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de récupération : " . $e->getMessage());
}

try{
    //autres
    $sqlAutres = "SELECT numUtilisateur, prenom, nom
                        FROM Utilisateur
                        WHERE numUtilisateur NOT IN (SELECT numUtilisateur FROM CompetiteurParticipe WHERE numConcours = :numConcours)
                        AND numUtilisateur IN (SELECT numUtilisateur FROM EvaluateurJury WHERE numConcours = :numConcours)
                        AND Utilisateur.numClub = :club";

    $stmtAutres = $connexion->prepare($sqlAutres);
    $stmtAutres->bindParam(':numConcours', $_GET['numConcours'], PDO::PARAM_INT);
    $stmtAutres->bindParam(':club', $numClub['numClub'], PDO::PARAM_INT);
    $stmtAutres->execute();
    $autres = $stmtAutres->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de récupération : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sélection des Participants</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="menu">
        <a href="index.php">Accueil</a>
        <a href="listeConcours.php">Retour aux Concours</a>
        <a href="logout.php">Déconnexion</a>
    </div>

    <div class="container">
        <h1>Participants pour le Concours : <?= htmlspecialchars($concours['theme']) ?></h1>
        <h1>club: <?= htmlspecialchars($numClub['numClub']) ?></h1>
        <h1>concou: <?= htmlspecialchars($_GET['numConcours']) ?></h1>

        <form action="traitement_participants.php" method="post">
            <input type="hidden" name="numConcours" value="<?= $_GET['numConcours'] ?>">

            <?php if (empty($competiteurs)): ?>
                <p>Aucun competiteur disponible pour ce concours.</p>

            <?php else: ?>
                <div class="container">
                    <?php foreach ($competiteurs as $competiteur): ?>
                        <div class="competiteurs-item">
                            <input type="checkbox" name="competiteurs[]" value="<?= $competiteur['numUtilisateur'] ?>" id="competiteurs<?= $competiteur['numUtilisateur'] ?>">
                            <label for="competiteurs<?= $competiteur['numUtilisateur'] ?>">
                                <?= htmlspecialchars($competiteur['prenom'] . ' ' . $competiteur['nom']. ' ' . $competiteur['numUtilisateur']) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>



            <?php if (empty($evaluateurs)): ?>
                <p>Aucun participant disponible pour ce concours.</p>
            <?php else: ?>
                <div class="container">
                    <?php foreach ($evaluateurs as $evaluateur): ?>
                        <div class="evaluateurs-item">
                            <input type="checkbox" name="evaluateurs[]" value="<?= $evaluateur['numUtilisateur'] ?>" id="evaluateurs<?= $evaluateur['numUtilisateur'] ?>">
                            <label for="evaluateurs<?= $evaluateur['numUtilisateur'] ?>">
                                <?= htmlspecialchars($evaluateur['prenom'] . ' ' . $evaluateur['nom']. ' ' . $evaluateur['numUtilisateur']) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>



            <?php if (empty($autres)): ?>
                <p>Aucun autre membre disponible pour ce concours.</p>
            <?php else: ?>
                <div class="liste-participants">
                    <?php foreach ($autres as $autre): ?>

                        <div class="autres-item">
                            <input type="checkbox" name="autres[]" value="<?= $autre['numUtilisateur'] ?>" id="autres<?= $autre['numUtilisateur'] ?>">
                            <label for="participant<?= $autre['numUtilisateur'] ?>">
                                <?= htmlspecialchars($autre['prenom'] . ' ' . $autre['nom']. ' ' . $autre['numUtilisateur']) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>


          <button type="submit">Valider la sélection</button>


        </form>
    </div>
</body>
</html>