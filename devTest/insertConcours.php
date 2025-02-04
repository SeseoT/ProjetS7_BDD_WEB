<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}else {//Redirection vers les pages spécialisé des clients
    try {
        $theme = htmlspecialchars(trim($_POST['theme']));
        $date_debut = htmlspecialchars(trim($_POST['date_debut']));
        $date_fin = htmlspecialchars(trim($_POST['date_fin']));
        $description = htmlspecialchars(trim($_POST['description'])); // Récupération de la description
        $numPresident = htmlspecialchars(trim($_POST['numPresident']));

        if (strlen($description) > 200) {
            echo "La description dépasse les 200 caractères autorisés.";
            exit();
        }
        // Requête d'insertion
        $query = "INSERT INTO Concours (theme, dateDebut, dateFin, etat, descriptif, numPresident) 
VALUES (
    :theme,
    :date_debut,
    :date_fin,
    'Non commence',
    :description,
    :numPresident);";


        $stmt = $connexion->prepare($query);
        $stmt->bindParam(':theme', $theme);
        $stmt->bindParam(':date_debut', $date_debut);
        $stmt->bindParam(':date_fin', $date_fin);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':numPresident', $numPresident, PDO::PARAM_INT);

        // Exécuter la requête
        if ($stmt->execute()) {
            header("Location: concoursAdmin.php"); // Rediriger vers le tableau de bord
            exit();
        } else {
            header("Location: concoursAdmin.php"); // Rediriger vers le tableau de bord
            exit();
        }
    } catch (PDOException $e) {
        print_r($numPresident);
        die("Erreur lors de la connexion : " . $e->getMessage());
    }
}
?>
;


