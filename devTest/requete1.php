<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}else{//Redirection vers les pages spécialisé des clients
    try {
        $sql = "SELECT Utilisateur.prenom, Utilisateur.nom, Utilisateur.adresse, Club.nomClub, Club.departement, Club.region, dateDebut, dateFin FROM Utilisateur, Club, Concours, Competiteur, CompetiteurParticipe WHERE Utilisateur.numUtilisateur = Competiteur.numCompetiteur AND Concours.numConcours = CompetiteurParticipe.numConcours AND CompetiteurParticipe.numCompetiteur = Competiteur.numCompetiteur AND Club.numClub = Utilisateur.numClub AND YEAR(Concours.dateFin) = '2023' GROUP BY Utilisateur.numUtilisateur, Utilisateur.prenom, Utilisateur.nom, Utilisateur.adresse, Club.nomClub, Club.departement, Club.region ";
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
                <th>Prénom</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Nom du Club</th>
                <th>Département</th>
                <th>Région</th>
                <th>Date de Début</th>
                <th>Date de Fin</th>
              </tr>';
    foreach ($result as $row) {//$row['prenom']
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($row['prenom']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['nom']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['adresse']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['nomClub']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['departement']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['region']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['dateDebut']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['dateFin']) . '</td>';
        $html .= '</tr>';
    }
    $html .= '</table>';
    // Envoyer le tableau
    echo $html;
}
?>
;


