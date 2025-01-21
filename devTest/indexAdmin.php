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
    <title>Page Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Bienvenue, <?= htmlspecialchars($_SESSION['username']); ?> !</h1>
    <p>Admin vous êtes connecté avec succès.</p>
    <a href="logout.php">Se déconnecter</a>
</div>
<button id="fetchData">Requete 1</button>
<div id="dataTable"></div>
<script>
    document.getElementById('fetchData').addEventListener('click', () => {
        fetch('requete1.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('dataTable').innerHTML = data;
            })
            .catch(error => console.error('Erreur:', error));
    });
</script>
</body>
</html>
