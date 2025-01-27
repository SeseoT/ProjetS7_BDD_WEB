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
    e1.numConcours,
    e1.numEvaluateur,
    e1.moyenne_notes
FROM (
    SELECT 
        d.numConcours,
        ev.numEvaluateur,
        AVG(ev.note) as moyenne_notes,
        RANK() OVER (PARTITION BY d.numConcours ORDER BY AVG(ev.note) DESC) as rang
    FROM Evaluation ev, Dessin d
    WHERE ev.numDessin = d.numDessin
    GROUP BY d.numConcours, ev.numEvaluateur
) e1
WHERE e1.rang = 1;
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
                <th>Numero du concours</th>
                <th>Numero évaluateur</th>
                <th>Note moyenne</th>
                </tr>';
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['numConcours']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['numEvaluateur']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['moyenne_notes']) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    // Envoyer le tableau
    echo $html;
}
?>