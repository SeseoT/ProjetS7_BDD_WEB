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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Utilisateur</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Bienvenue, <?= htmlspecialchars($prenom); ?> <?= htmlspecialchars($nom); ?> !</h1>
    <p>Vous êtes connecté avec succès.</p>
    <a href="logout.php">Se déconnecter</a>
</div>
</body>
</html>
