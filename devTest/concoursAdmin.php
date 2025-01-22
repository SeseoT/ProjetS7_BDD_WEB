<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion
require('functions.php'); // Inclure le fichier de fonctions

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} else {

}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Concours</title>
    <link rel="stylesheet" href="style.css">
    <!-- Script JS -->
    <script src="script.js"></script>
</head>

<body>

<!-- Header -->
<!-- Menu de navigation -->
<div class="menu">
    <a href="index.php">Accueil</a>
    <a href="concoursAdmin.php">Les Concours</a>
    <a href="profile.php">Mon Profil</a>
    <a href="logout.php">Se déconnecter</a>
</div>

<!-- Contenu principal -->
<div class="container">
    <h2>Créer un concours</h2>
        <div class="user-info">
        </div>
    <form method="POST" action="insertConcours.php">
        <label for="theme">Theme</label>
        <input type="text" name="theme" id="theme" required>

        <label for="date_debut">Date de Début :</label>
        <input type="date" name="date_debut" id="date_debut" required><br><br>

        <label for="date_fin">Date de Fin :</label>
        <input type="date" name="date_fin" id="date_fin" required><br><br>

        <label for="description">Description :</label><br>
        <textarea name="description" id="description" rows="5" cols="40" maxlength="200"
                  placeholder="Ajoutez une courte description (200 caractères max)" required></textarea><br><br>


        <label for="numeroPresident">Numero president :</label>
            <?php
                try {
                    $sql = "SELECT Utilisateur.nom, Utilisateur.prenom ,Utilisateur.numUtilisateur
                            FROM Utilisateur;";
                    $stmt = $connexion->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                }
                catch (PDOException $e) {
                    die("Erreur lors de la connexion : " . $e->getMessage());
                }
                $listUser .='<select name="numPresident" id="numPresident">';
                foreach ($result as $row) {//$row['prenom']
                    $listUser .= '<option value='. htmlspecialchars($row['numUtilisateur']) .'>'. htmlspecialchars($row['nom']) .' '. htmlspecialchars($row['prenom']) .'</option>';
                }
                $listUser .='</select>';
                // Envoyer le tableau
                echo $listUser;
            ?>
        <button type="submit">Ajouter le concours</button>
    </form>
</div>


<div class="container center">
    <h2>Liste des concours actuel</h2>
    <?php
        try {
            $sql = "SELECT * FROM Concours";
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            die("Erreur lors de la connexion : " . $e->getMessage());
        }
    $html = '<table border="1">';
    $html .= '<tr>
                <th>Numéro du concours</th>
                <th>Theme</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
                <th>Etat</th>
                <th>Descriptif</th>
                <th>Numéro du president</th>
              </tr>';
    foreach ($result as $row) {//$row['prenom']
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['numConcours']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['theme']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['dateDebut']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['dateFin']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['etat']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['descriptif']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['numPresident']) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    // Envoyer le tableau
    echo $html;
    ?>
</div>





</body>

</html>
