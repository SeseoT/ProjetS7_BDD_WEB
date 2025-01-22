<?php

function requeteSQL($id_user, $connexion, $sql, $fetchAll) {
    try {
        // Préparer la requête SQL avec l'ID de l'utilisateur
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();

        // Récupérer les résultats de la requête
        //$result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($fetchAll) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère tous les résultats sous forme de tableau
        } else {
            $result = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère un seul résultat
        }

    } catch (PDOException $e) {
        die("Erreur lors de la connexion : " . $e->getMessage());
    }

    // Retourner les résultats de la requête
    return $result;
}


$sqlVerifierUserConcoursEnCours = "
         SELECT DISTINCT
            Concours.theme
        FROM 
            Concours, Utilisateur, CompetiteurParticipe, EvaluateurJury, President
        WHERE 
            (President.numPresident = Utilisateur.numUtilisateur 
                AND Utilisateur.numUtilisateur = :id_user
                AND President.numPresident = Concours.numPresident
            OR CompetiteurParticipe.numCompetiteur = Utilisateur.numUtilisateur 
                AND Utilisateur.numUtilisateur = :id_user
                AND Concours.numConcours = CompetiteurParticipe.numConcours
            OR EvaluateurJury.numEvaluateur = Utilisateur.numUtilisateur 
                AND Utilisateur.numUtilisateur = :id_user
                AND EvaluateurJury.numConcours = Concours.numConcours
            )
            AND Concours.etat = 'En Cours';";

?>
