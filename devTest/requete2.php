<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}else{//Redirection vers les pages spécialisé des clients
    try {
        $sql = "SELECT U.nom, U.prenom,D.numDessin , AVG(E.note) AS moyenneNote, Concours.theme,Concours.descriptif
FROM Evaluation E, Dessin D, Competiteur C, Utilisateur U  , Concours
WHERE YEAR(E.dateEvaluation) = 2024  
  AND E.numDessin = D.numDessin  
  AND D.numCompetiteur = C.numCompetiteur  
  AND C.numCompetiteur = U.numUtilisateur  
GROUP BY U.nom, U.prenom
ORDER BY moyenneNote ";

        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
    }
    catch (PDOException $e) {
        die("Erreur lors de la connexion : " . $e->getMessage());
    }
    // Construire le tableau HTML
    $html = '<table border="1">';
    $html .= '<tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Numéro du dessin</th>
                <th>Note (Moyenne)</th>
                <th>Theme Concours</th>
                <th>Descriptif Concours</th>
              </tr>';
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['nom']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['prenom']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['numDessin']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['moyenneNote']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['theme']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['descriptif']) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    // Envoyer le tableau
    echo $html;
}
?>
;


