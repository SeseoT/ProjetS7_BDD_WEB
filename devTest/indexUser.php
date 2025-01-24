<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} else {
    try {
        $sql = "SELECT Utilisateur.nom, Utilisateur.prenom, Utilisateur.adresse, Club.nomClub
        FROM Utilisateur, Club
        WHERE numUtilisateur = :id_user
        AND Utilisateur.numClub = Club.numClub";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id_user', $_SESSION['id_user']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);


    } catch (PDOException $e) {
        die("Erreur lors de la connexion : " . $e->getMessage());
    }
    if ($stmt->rowCount() > 0) {
        $prenom = $result['prenom'];
        $nom = $result['nom'];
        $adresse = $result['adresse'];
        $nomClub = $result['nomClub'];
    } else {
        $prenom = "Erreur";
        $nom = "Erreur";
        $adresse = "Erreur";
        $nomClub = "Erreur";
        echo "Nom d'utilisateur ou mot de passe incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Utilisateur</title>
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
    <h1>Bienvenue sur votre espace personnel</h1>
</div>

     <?php if (isset($_SESSION['isDirecteur']) && $_SESSION['isDirecteur'] == 1): ?>
        <a href="indexDirecteur.php" class="bandeauDirecteur">Créer Participante</a>
        <a href="choisirarticipants.php" class="bandeauDirecteur">Choisir Participants</a>
     <?php endif; ?>

<!-- Contenu principal -->
<div class="container">

    <h2>Vos informations personnelles : </h2>
    <div class="user-info">
        <p><span class="user-data">Prénom :</span> <?= htmlspecialchars($prenom); ?></p>
        <p><span class="user-data">Nom :</span> <?= htmlspecialchars($nom); ?></p>
        <p><span class="user-data">Adresse :</span> <?= htmlspecialchars($adresse); ?></p>
        <p><span class="user-data">Club :</span> <?= htmlspecialchars($nomClub); ?></p>
    </div>


</div>

</body>

</html>
