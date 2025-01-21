<?php
session_start();

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
    <title>Tableau de Bord</title>
</head>
<body>
<h1>Bienvenue, <?= htmlspecialchars($_SESSION['username']); ?> !</h1>
<p>Vous êtes connecté avec succès.</p>
<a href="logout.php">Se déconnecter</a>
</body>
</html>
