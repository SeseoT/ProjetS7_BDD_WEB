<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location:login.php");
    exit();
}
else {

    if (isset($_SESSION['isDirecteur']) && $_SESSION['isDirecteur'] != 1){
        echo"Vous n'etes pas directeur erreur";
        header("Location:indexUser.php");
        exit();
    }

    try {
        $sql_idClub = 'SELECT numClub FROM Directeur WHERE Directeur.numDirecteur = :id_user';
        $stmt_idClub = $connexion->prepare($sql_idClub);
        $stmt_idClub->bindParam(':id_user', $_SESSION['id_user']);
        $stmt_idClub->execute();
        $result = $stmt_idClub->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die("Erreur lors de la connexion : " . $e->getMessage());
    }

     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {

        try {
         $sql_CreerUtilisateur = "INSERT INTO Utilisateur (numUtilisateur, nom, prenom,age , adresse, login, motDePasse, numClub)
               VALUES (:numUtilisateur, :nom, :prenom, :age, :adresse,:login,:motDePasse, :numClub)";
          $stmt_CreerUtilisateur = $connexion->prepare($sql_CreerUtilisateur);

          // Liaison des paramètres
          $stmt_CreerUtilisateur->bindParam(':numUtilisateur', $_POST['numUtilisateur']);
          $stmt_CreerUtilisateur->bindParam(':nom', $_POST['nom']);
          $stmt_CreerUtilisateur->bindParam(':prenom', $_POST['prenom']);
          $stmt_CreerUtilisateur->bindParam(':age', $_POST['age']);
          $stmt_CreerUtilisateur->bindParam(':adresse', $_POST['adresse']);
          $stmt_CreerUtilisateur->bindParam(':login', $_POST['login']);
          $stmt_CreerUtilisateur->bindParam(':motDePasse', $_POST['motDePasse']);
          $stmt_CreerUtilisateur->bindParam(':numClub', $result['numClub']);

          $stmt_CreerUtilisateur->execute();
          echo "<p class='success'>Utilisateur ajouté avec succès !</p>";

        } catch (PDOException $e) {
        echo "<p class='error'>Erreur lors de l'ajout : ".htmlspecialchars($e->getMessage())."</p>";
        }



    }else {
      echo "<p class='error'>Tous les champs sont obligatoires.</p>";
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
    <h1>Créer un nouveau membre du club</h1>
</div>


<!-- Contenu principal -->
<div class="container">

    <h2>Vos informations personnelles : </h2>
    <p>aaa<?= htmlspecialchars($_SESSION['id_user']); ?>bbb</p>
    <p><?= htmlspecialchars($result['numClub']); ?></p>
    <p>numclub</p>
    <div class="formulaireNouveauParticipant">
        <form method="POST" action="">

            <label for="numUtilisateur">numUtilisateur :</label>
            <input type="text" id="numUtilisateur" name="numUtilisateur" required>

            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="prenom">Prenom :</label>
            <input type="text" id="prenom" name="prenom" required>

            <label for="age">age :</label>
            <input type="number" id="age" name="age" required>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" required>

            <label for="login">Login :</label>
            <input type="text" id="login" name="login" required>

            <label for="motDePasse">Mot de passe :</label>
            <input type="password" id="motDePasse" name="motDePasse" required>

            <button type="submit" name = "create">"Creer l'utilisateur"</button>
        </form>

    </div>


</div>

</body>

</html>
