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
<button id="fetchDataR1">Requete 1</button>
<div id="dataTableR1"></div>
<button id="fetchDataR2">Requete 2</button>
<div id="dataTableR2"></div>
<script>
    document.getElementById('fetchDataR1').addEventListener('click', () => {
        fetch('requete1.php')
            .then(response => {
                return response.text()})
            .then(data => {
                document.getElementById('dataTableR1').innerHTML = data;
            })
            .catch(error => console.error('Erreur:', error));
    });

    document.getElementById('fetchDataR2').addEventListener('click', () => {
        fetch('requete2.php')
            .then(response => {
                return response.text()})
            .then(data => {
                document.getElementById('dataTableR2').innerHTML = data;
            })
            .catch(error => console.error('Erreur:', error));
    });
</script>
</body>
</html>
