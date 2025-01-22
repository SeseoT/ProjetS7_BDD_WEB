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

<div class="container center">
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



<!-- Contenu principal -->
<div class="container">
    <h2>Liste des concours passés</h2>
    <div class="user-info">
        <p><span class="user-data">Theme :</span> <?= htmlspecialchars($theme); ?></p>
    </div>
</div>

</body>

</html>
