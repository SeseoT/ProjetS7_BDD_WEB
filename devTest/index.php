<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}else{//Redirection vers les pages spécialisé des clients
    try {
        $sql = "SELECT * FROM Administrateur WHERE numAdministrateur = :id_user";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':id_user', $_SESSION['id_user']);
        $stmt->execute();
    }
    catch (PDOException $e) {
        die("Erreur lors de la connexion : " . $e->getMessage());
    }
    if($stmt->rowCount() > 0){
        header("Location: indexAdmin.php"); // Rediriger vers le tableau de bord
        exit();
    }else{
        header("Location: indexUser.php"); // Rediriger vers le tableau de bord
        exit();
    }
}

?>

