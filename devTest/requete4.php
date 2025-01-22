<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}else{//Redirection vers les pages spécialisé des clients
    try {
        $sql = "SELECT DISTINCT Utilisateur.nom, Utilisateur.prenom,Utilisateur.age
FROM Utilisateur, Concours, Competiteur, CompetiteurParticipe
WHERE Utilisateur.numUtilisateur = Competiteur.numCompetiteur
  AND CompetiteurParticipe.numCompetiteur = Competiteur.numCompetiteur
  AND CompetiteurParticipe.numConcours = Concours.numConcours
  AND Competiteur.numCompetiteur IN (
      SELECT numCompetiteur
FROM CompetiteurParticipe
GROUP BY numCompetiteur
HAVING COUNT(*) = 11
ORDER BY COUNT(*) DESC)
ORDER BY age;";

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
                <th>Nom</th>
                <th>Prenom</th>
                <th>Age</th>
                </tr>';
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['nom']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['prenom']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['age']) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    // Envoyer le tableau
    echo $html;
}
?>