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
    Club.region,
    AVG(Evaluation.note) AS MoyenneNote
FROM
    Evaluation, Club, Dessin, Evaluateur, Utilisateur
WHERE
    Dessin.numDessin = Evaluation.numDessin
    AND Evaluation.numEvaluateur = Evaluateur.numEvaluateur
    AND Evaluateur.numEvaluateur = Utilisateur.numUtilisateur
    AND Utilisateur.numClub = Club.numClub
    AND Evaluation.note IS NOT NULL
GROUP BY
    Club.region
ORDER BY
    MoyenneNote DESC
LIMIT 1;
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
                <th>Region</th>
                <th>Note Moyenne</th>
                </tr>';
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['region']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['MoyenneNote']) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    // Envoyer le tableau
    echo $html;
}
?>
;