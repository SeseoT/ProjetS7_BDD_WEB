<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}else{//Redirection vers les pages spécialisé des clients
    try {
        $sql = "SELECT 
    (SELECT theme 
     FROM Concours 
     WHERE Concours.numConcours = cp.numConcours) AS themeConcours,
    (SELECT prenom 
     FROM Utilisateur 
     WHERE Utilisateur.numUtilisateur = cp.numCompetiteur) AS prenomUtilisateur,
    (SELECT nom 
     FROM Utilisateur 
     WHERE Utilisateur.numUtilisateur = cp.numCompetiteur) AS nomUtilisateur,
     (SELECT age 
     FROM Utilisateur 
     WHERE Utilisateur.numUtilisateur = cp.numCompetiteur) AS age,
    (SELECT COUNT(*) 
     FROM Dessin 
     WHERE Dessin.numConcours = cp.numConcours 
       AND Dessin.numCompetiteur = cp.numCompetiteur) AS nombreDessins
FROM CompetiteurParticipe cp, Utilisateur
WHERE (SELECT COUNT(*) 
       FROM Dessin 
       WHERE Dessin.numConcours = cp.numConcours 
         AND Dessin.numCompetiteur = cp.numCompetiteur) > 2
AND cp.numCompetiteur = Utilisateur.numUtilisateur
ORDER BY Utilisateur.age;
";

        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        die("Erreur lors de la connexion : " . $e->getMessage());
    }
    // Construire le tableau HTML
    $html = '<table border="1">';
    $html .= '<tr>
                <th>Theme Concours</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Age</th>
                <th>Nombre dessin</th>
                </tr>';
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['themeConcours']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['prenomUtilisateur']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['nomUtilisateur']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['age']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['nombreDessins']) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    // Envoyer le tableau
    echo $html;
}
?>