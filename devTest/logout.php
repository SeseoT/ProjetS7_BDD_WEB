<?php
session_start();
session_destroy(); // Détruire toutes les variables de session
header("Location: login.php"); // Rediriger vers la page de connexion
exit();
?>
