<?php
session_start(); // Pour gérer les sessions
require("connect.php"); // Inclure la configuration de connexion

// Vérification des données envoyées via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    try {
        // Requête pour vérifier les identifiants
        $sql = "SELECT * FROM Utilisateur WHERE login = :username AND motDePasse = :password";
        $stmt = $connexion->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si un utilisateur correspondant existe
        if ($stmt->rowCount() > 0) {
            $_SESSION['username'] = $username; // Stocker le nom d'utilisateur dans la session
            $_SESSION['id_user'] =  $result['numUtilisateur'];
            header("Location: index.php"); // Rediriger vers le tableau de bord
            exit();
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        die("Erreur lors de la connexion : " . $e->getMessage());
    }
} else {
    header("Location: login.php"); // Rediriger vers la page de connexion si le formulaire n'a pas été soumis
    exit();
}
?>
