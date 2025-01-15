<?php
// Vérifie si les données ont été envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
} else {
    // Si l'utilisateur accède à cette page sans soumettre le formulaire, redirection vers le formulaire
    header("Location: formulaire.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>
<body>
    <h1>Merci pour votre inscription !</h1>
    <p>Nom : <?= $name; ?></p>
    <p>Email : <?= $email; ?></p>
    <a href="formulaire.php">Retour au formulaire</a>
</body>
</html>
