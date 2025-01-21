<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
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
    <h1>Bienvenue, <?= htmlspecialchars($_SESSION['username']); ?> !</h1>
    <p>Vous êtes connecté avec succès.</p>
    <a href="logout.php">Se déconnecter</a>
</div>
</body>
</html>
