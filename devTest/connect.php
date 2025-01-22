<?php
define('USER', "db_etu");           // Nom d'utilisateur de la base de données
define('PASSWD', "N3twork!");        // Mot de passe de la base de données
define('SERVER', "localhost");    // Hôte du serveur de base de données
define('BASE', "db_site");        // Nom de la base de données
//define('BASE', "db_site");        // Nom de la base de données

try {
    // Connexion à la base de données
    $dsn = "mysql:dbname=" . BASE . ";host=" . SERVER;
    $connexion = new PDO($dsn, USER, PASSWD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}
?>
