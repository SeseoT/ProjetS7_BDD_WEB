<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}else{

}
?>
<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- Menu de navigation -->
<div class="menu">
    <a href="index.php">Accueil</a>
    <a href="concoursAdmin.php">Les Concours</a>
    <a href="clubAdmin.php">Les Clubs</a>
    <a href="logout.php">Se déconnecter</a>
</div>
<style>
    .scrollable-table {
        max-height: 300px; /* Limiter la hauteur maximale */
        overflow-y: auto; /* Activer le défilement vertical */
        overflow-x: auto; /* Activer le défilement horizontal */
        width: 100%; /* S'assurer que le tableau utilise toute la largeur du parent */
        border: 1px solid #ccc; /* Ajouter une bordure pour distinguer */
        padding: 10px; /* Ajouter de l'espace interne */
        box-sizing: border-box;
        background-color: #f9f9f9; /* Couleur de fond pour lisibilité */
        justify-content: center; /* Centrer horizontalement le contenu */
        align-items: center; /* Centrer verticalement le contenu */
        display: grid;
    }

    .scrollable-table table {
        width: 100%; /* Assure que le tableau prend toute la largeur disponible */
        table-layout: auto; /* Laisser les colonnes s'adapter automatiquement */
        border-collapse: collapse; /* Suppression des espaces entre les bordures */
        font-size: 14px; /* Taille de caractère réduite pour s'adapter */
    }

    .scrollable-table th, .scrollable-table td {
        text-align: left; /* Alignement du texte à gauche */
        padding: 8px; /* Ajouter de l'espace dans les cellules */
        border: 1px solid #ddd; /* Ajouter des bordures pour plus de lisibilité */
        word-wrap: break-word; /* Casser les mots trop longs */
    }

    .scrollable-table th {
        background-color: #f2f2f2; /* Couleur d'en-tête plus claire */
    }

    .scrollable-table.hidden {
        display: none; /* Masquer les tableaux par défaut */
    }

    /* Responsive: Ajuster les caractères sur des petits écrans */
    @media (max-width: 768px) {
        .scrollable-table table {
            font-size: 12px; /* Réduire davantage la taille des caractères */
        }
    }



</style>
<div class="container center">
    <h2>Les requetes SQL</h2>
    <button id="fetchDataR1" title="Afficher le nom et l’adresse et l’âge de tous les compétiteurs qui ont participé dans un con-cours en 2023.">Requete 1</button>
    <div id="dataTableR1" class="scrollable-table hidden"></div>
    <br>
    <button id="fetchDataR2" title ="Afficher par ordre croissant de la note tous les dessins qui ont été évalués en 2023." >Requete 2</button>
    <div id="dataTableR2" class="scrollable-table hidden"></div>
    <br>
    <button id="fetchDataR3" title = "Pour cette requête on vous demande d’afficher des informations sur tous les dessins qui ont été évalués et qui sont stockés dans la base.">Requete 3</button>
    <div id="dataTableR3" class="scrollable-table hidden"></div>
    <br>
    <button id="fetchDataR4" title="Nom, prénom et âge des compétiteurs qui ont participé à tous les concours qui ont été
    organisés. L’affichage doit se faire dans l’ordre croissant des âges.">Requete 4</button>
    <div id="dataTableR4" class="scrollable-table hidden"></div>
    <br>
    <button id="fetchDataR5" title="Nom de la région qui a la meilleure moyenne des notes des dessins proposés.">Requete 5</button>
    <div id="dataTableR5" class="scrollable-table hidden"></div>
    <br>
    <button id="fetchDataR6">Requete 6</button>
    <div id="dataTableR6" class="scrollable-table hidden"></div>
    <br>
    <button id="fetchDataR7">Requete 7</button>
    <div id="dataTableR7" class="scrollable-table hidden"></div>
    <br>
    <button id="fetchDataR8">Requete 8</button>
    <div id="dataTableR8" class="scrollable-table hidden"></div>
</div>
<script>

    document.getElementById('fetchDataR1').addEventListener('click', () => {
        fetch('requete1.php')
            .then(response => {
                return response.text()})
            .then(data => {
                document.getElementById('dataTableR1').innerHTML = data;
                if (document.getElementById('dataTableR1').classList.contains("hidden")) {
                    document.getElementById('dataTableR1').classList.remove("hidden");
                }else{
                    document.getElementById('dataTableR1').classList.add("hidden");
                }
            })
            .catch(error => console.error('Erreur:', error));
    });
    document.getElementById('fetchDataR2').addEventListener('click', () => {
        fetch('requete2.php')
            .then(response => {
                return response.text()})
            .then(data => {
                document.getElementById('dataTableR2').innerHTML = data;
                if (document.getElementById('dataTableR2').classList.contains("hidden")) {
                    document.getElementById('dataTableR2').classList.remove("hidden");
                }else{
                    document.getElementById('dataTableR2').classList.add("hidden");
                }
            })
            .catch(error => console.error('Erreur:', error));
    });
    document.getElementById('fetchDataR3').addEventListener('click', () => {
        fetch('requete3.php')
            .then(response => {
                return response.text()})
            .then(data => {
                document.getElementById('dataTableR3').innerHTML = data;
                if (document.getElementById('dataTableR3').classList.contains("hidden")) {
                    document.getElementById('dataTableR3').classList.remove("hidden");
                }else{
                    document.getElementById('dataTableR3').classList.add("hidden");
                }
            })
            .catch(error => console.error('Erreur:', error));
    });
    document.getElementById('fetchDataR4').addEventListener('click', () => {
        fetch('requete4.php')
            .then(response => {
                return response.text()})
            .then(data => {
                document.getElementById('dataTableR4').innerHTML = data;
                if (document.getElementById('dataTableR4').classList.contains("hidden")) {
                    document.getElementById('dataTableR4').classList.remove("hidden");
                }else{
                    document.getElementById('dataTableR4').classList.add("hidden");
                }
            })
            .catch(error => console.error('Erreur:', error));
    });
    document.getElementById('fetchDataR5').addEventListener('click', () => {
        fetch('requete5.php')
            .then(response => {
                return response.text()})
            .then(data => {
                document.getElementById('dataTableR5').innerHTML = data;
                if (document.getElementById('dataTableR5').classList.contains("hidden")) {
                    document.getElementById('dataTableR5').classList.remove("hidden");
                }else{
                    document.getElementById('dataTableR5').classList.add("hidden");
                }
            })
            .catch(error => console.error('Erreur:', error));
    });
    document.getElementById('fetchDataR6').addEventListener('click', () => {
        fetch('requete6.php')
            .then(response => {
                return response.text()})
            .then(data => {
                document.getElementById('dataTableR6').innerHTML = data;
                if (document.getElementById('dataTableR6').classList.contains("hidden")) {
                    document.getElementById('dataTableR6').classList.remove("hidden");
                }else{
                    document.getElementById('dataTableR6').classList.add("hidden");
                }
            })
            .catch(error => console.error('Erreur:', error));
    });
    document.getElementById('fetchDataR7').addEventListener('click', () => {
        fetch('requete7.php')
            .then(response => {
                return response.text()})
            .then(data => {
                document.getElementById('dataTableR7').innerHTML = data;
                if (document.getElementById('dataTableR7').classList.contains("hidden")) {
                    document.getElementById('dataTableR7').classList.remove("hidden");
                }else{
                    document.getElementById('dataTableR7').classList.add("hidden");
                }
            })
            .catch(error => console.error('Erreur:', error));
    });
    document.getElementById('fetchDataR8').addEventListener('click', () => {
        fetch('requete8.php')
            .then(response => {
                return response.text()})
            .then(data => {
                document.getElementById('dataTableR8').innerHTML = data;
                if (document.getElementById('dataTableR8').classList.contains("hidden")) {
                    document.getElementById('dataTableR8').classList.remove("hidden");
                }else{
                    document.getElementById('dataTableR8').classList.add("hidden");
                }
            })
            .catch(error => console.error('Erreur:', error));
    });
</script>
</body>
</html>
