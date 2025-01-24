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
        <a href="clubAdmin.php">Les Clubs</a>
        <a href="logout.php">Se déconnecter</a>
    </div>

    <!-- Contenu principal -->
    <div class="container center">
        <h2>Liste des concours actuel</h2>
        <?php
        try {
            $sql = "SELECT * FROM Club";
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            die("Erreur lors de la connexion : " . $e->getMessage());
        }
        $html = '<table border="1">';
        $html .= '<tr>
                <th>Numero du club</th>
                <th>Nom du club</th>
                <th>Adresse</th>
                <th>Numero de télephone</th>
                <th>Nombre adhérents</th>
                <th>Ville</th>
                <th>Départements</th>
                <th>Région</th>
              </tr>';
        foreach ($result as $row) {//$row['prenom']
            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($row['numClub']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['nomClub']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['adresse']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['numTelephone']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['nombreAdherents']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['ville']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['departement']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['region']) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';
        // Envoyer le tableau
        echo $html;
        ?>
    </div>





    </body>

    </html>
<?php
