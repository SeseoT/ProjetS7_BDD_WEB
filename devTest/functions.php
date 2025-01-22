<?php

function requeteSQL($id_user, $connexion, $sql, $fetchAll) {
    try {
        // Pr�parer la requ�te SQL avec l'ID de l'utilisateur
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();

        // R�cup�rer les r�sultats de la requ�te
        //$result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($fetchAll) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // R�cup�re tous les r�sultats sous forme de tableau
        } else {
            $result = $stmt->fetch(PDO::FETCH_ASSOC); // R�cup�re un seul r�sultat
        }

    } catch (PDOException $e) {
        die("Erreur lors de la connexion : " . $e->getMessage());
    }

    // Retourner les r�sultats de la requ�te
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
