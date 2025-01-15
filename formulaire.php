<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Simple</title>
</head>
<body>
    <h1>Formulaire d'inscription</h1>
    <form method="POST" action="confirmation.php">
        <label for="name">Nom :</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
