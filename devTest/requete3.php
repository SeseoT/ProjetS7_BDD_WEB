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
    Dessin.numDessin AS NumeroDessin,
    YEAR(Concours.dateDebut) AS AnneeConcours,
    Concours.theme AS ThemeConcours,
    Concours.descriptif AS DescriptifConcours,
    Concours.numConcours As NumeroConcours,
    UtilisateurCompetiteur.nom AS NomCompetiteur,
    Dessin.numDessin AS NumeroDessinCompetiteur,
    Dessin.commentaire AS CommentaireDessin,
    Evaluation.note AS NoteEvaluation,
    Evaluation.commentaire AS CommentaireEvaluation,
    UtilisateurEvaluateur.nom AS NomEvaluateur
FROM 
    Dessin, Evaluation, Concours, Competiteur, Utilisateur AS UtilisateurCompetiteur, 
    Evaluateur, Utilisateur AS UtilisateurEvaluateur
WHERE 
    Dessin.numDessin = Evaluation.numDessin
    AND Dessin.numConcours = Concours.numConcours
    AND Dessin.numCompetiteur = Competiteur.numCompetiteur
    AND Competiteur.numCompetiteur = UtilisateurCompetiteur.numUtilisateur
    AND Evaluation.numEvaluateur = Evaluateur.numEvaluateur
    AND Evaluateur.numEvaluateur = UtilisateurEvaluateur.numUtilisateur";

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
                <th>Numero Dessin</th>
                <th>Annee</th>
                <th>Theme Concours</th>
                <th>Descriptif Concours</th>
                <th>Numero Concours</th>
                <th>Nom Competiteur</th>
                <th>Numero Dessin</th>
                <th>Commentaire Dessin</th>
                <th>Note de l évaluation</th>
                <th>Commentaire évaluation</th>
                <th>Nom évaluateur</th>
              </tr>';
    foreach ($result as $row) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['NumeroDessin']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['AnneeConcours']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['ThemeConcours']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['DescriptifConcours']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['NumeroConcours']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['NomCompetiteur']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['NumeroDessinCompetiteur']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['CommentaireDessin']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['NoteEvaluation']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['CommentaireEvaluation']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['NomEvaluateur']) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    // Envoyer le tableau
    echo $html;
}
?>


