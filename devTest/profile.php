<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} else {
    function getQuoteOfTheDay($prenom) {
        $citations = [
            "« La seule limite est celle que tu te fixes, %s ! »",
            "« %s, chaque mouvement est une chance de briller ! »",
            "« La perfection n'est pas un acte, c'est une habitude. Continue comme ça, %s ! »",
            "« %s, tu es capable de tout ce que tu imagines ! »",
            "« La gymnastique est une poésie du mouvement. Écris ton histoire, %s ! »",
            "« %s, rappelle-toi : la grâce est plus forte que la gravité ! »",
            "« Le talent gagne des matchs, mais le travail d'équipe gagne des championnats. Bravo %s ! »"
        ];
        
        $index = date('z') % count($citations); // Change chaque jour
        return sprintf($citations[$index], $prenom);
    }

// Récupérer la citation
$citation_du_jour = getQuoteOfTheDay($prenom);
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

    <style>
.citation-container {
    background: linear-gradient(45deg, #f3f4f6, #ffffff);
    padding: 20px;
    border-radius: 15px;
    margin: 20px 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: relative;
}

.citation-texte {
    font-style: italic;
    font-size: 1.1em;
    color: #2c3e50;
    text-align: center;
    margin: 0;
}

.citation-container::before {
    content: '"';
    position: absolute;
    top: -20px;
    left: 20px;
    font-size: 60px;
    color: #ddd;
    font-family: serif;
}
</style>
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
        <a href="creerUtilisateur.php" class="bandeauDirecteur">Créer Participante</a>
        <a href="directeurChoisisConcoursAInteragir.php" class="bandeauDirecteur">Choisir Participants</a>
     <?php endif; ?>

<!-- Contenu principal -->
<div class="container">

    <h2>Votre profile : </h2>
    <div class="user-info">
        <p><span class="user-data">Prénom :</span> <?= htmlspecialchars($prenom); ?></p>
        <p><span class="user-data">Nom :</span> <?= htmlspecialchars($nom); ?></p>
        <p><span class="user-data">Adresse :</span> <?= htmlspecialchars($adresse); ?></p>
        <p><span class="user-data">Club :</span> <?= htmlspecialchars($nomClub); ?></p>
    </div>

<div class="citation-container">
    <p class="citation-texte"><?= htmlspecialchars($citation_du_jour); ?></p>
</div>

</div>

</body>

</html>
