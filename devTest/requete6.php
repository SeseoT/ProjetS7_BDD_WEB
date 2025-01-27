<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}else{//Redirection vers les pages spécialisé des clients
    try {
        $sql = "SELECT numEvaluateur, (SELECT nom FROM Utilisateur WHERE Utilisateur.numUtilisateur = Evaluateur.numEvaluateur) AS nom, (SELECT prenom FROM Utilisateur WHERE Utilisateur.numUtilisateur = Evaluateur.numEvaluateur) AS prenom, (SELECT age FROM Utilisateur WHERE Utilisateur.numUtilisateur = Evaluateur.numEvaluateur) AS age, (SELECT COUNT(*) FROM Evaluation WHERE Evaluation.numEvaluateur = Evaluateur.numEvaluateur) AS total_evaluations FROM Evaluateur WHERE numEvaluateur IN ( SELECT numEvaluateur FROM Evaluation ) ORDER BY total_evaluations DESC;";

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
                <th>Numero évaluateur</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Age</th>
                <th>Nombre évaluation</th>
                </tr>';
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['numEvaluateur']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['nom']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['prenom']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['age']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['total_evaluations']) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    // Envoyer le tableau
    echo $html;
}
?>