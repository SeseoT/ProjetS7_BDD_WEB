<?php
session_start(); // Pour gérer les sessions
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Connexion à votre compte</h1>
    <form method="POST" action="process_login.php">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se connecter</button>
    </form>
    <?php if (isset($_SESSION['badConnection']) && $_SESSION['badConnection'] == 1): ?>
        <p>Nom d'utilisateur ou mot de passe incorrect.</p>
    <?php endif; ?>
    <h2 href="index.html">Retour</h2>
</div>
</body>
</html>
