<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}else{//Redirection vers les pages spécialisé des clients
    try {
        $sql = "SELECT * FROM Administrateur WHERE numAdministrateur = :id_user";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id_user', $_SESSION['id_user']);
        $stmt->execute();
    }
    catch (PDOException $e) {
        die("Erreur lors de la connexion : " . $e->getMessage());
    }
    if($stmt->rowCount() > 0){
        header("Location: indexAdmin.php"); // Rediriger vers le tableau de bord
        exit();
    }else{
        header("Location: indexUser.php"); // Rediriger vers le tableau de bord
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Bienvenue, <?= htmlspecialchars($_SESSION['username']); ?> !</h1>
    <p>Vous êtes connecté avec succès.</p>
    <a href="logout.php">Se déconnecter</a>
</div>
</body>
</html>
