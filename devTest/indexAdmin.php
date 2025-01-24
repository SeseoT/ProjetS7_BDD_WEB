<?php
session_start();
require("connect.php"); // Inclure la configuration de connexion
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
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
    <a href="concoursAdmin.php">Les Clubs</a>
    <a href="profile.php">Mon Profil</a>
    <a href="logout.php">Se déconnecter</a>
</div>
<style>
    .scrollable-table {
        max-height: 300px; /* Limiter la hauteur maximale */
        overflow-y: auto; /* Activer le défilement vertical */
        width: 100%; /* S'assurer que le tableau utilise toute la largeur du parent */
        border: 1px solid #ccc; /* Ajouter une bordure pour distinguer */
        padding: 10px; /* Ajouter de l'espace interne */
        box-sizing: border-box;
        background-color: #f9f9f9; /* Couleur de fond pour lisibilité */
        justify-content: center; /* Centrer horizontalement le contenu */
        align-items: center; /* Centrer verticalement le contenu */
        display: grid;
    }

    .scrollable-table.hidden {
        display: none;
    }

    /* Overlay (flou + texte au centre) */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Fond semi-transparent */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000; /* Toujours au-dessus */
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s ease;
    }

    .overlay.active {
        opacity: 1;
        pointer-events: all;
    }

    .overlay-text {
        color: white;
        font-size: 24px;
        text-align: center;
        padding: 20px;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 8px;
    }

    /* Effet de flou sur la page quand l'overlay est actif */
    .blurred {
        filter: blur(5px);
        pointer-events: none; /* Désactiver les clics */
    }


</style>
<div class="container center">
    <button id="fetchDataR1" data-tooltip="Texte pour Requete 1">Requete 1</button>
    <div id="dataTableR1" class="scrollable-table hidden"></div>
    <br>
    <button id="fetchDataR2">Requete 2</button>
    <div id="dataTableR2" class="scrollable-table hidden"></div>
    <br>
    <button id="fetchDataR3">Requete 3</button>
    <div id="dataTableR3" class="scrollable-table hidden"></div>
    <br>
    <button id="fetchDataR4">Requete 4</button>
    <div id="dataTableR4" class="scrollable-table hidden"></div>
    <br>
    <button id="fetchDataR5">Requete 5</button>
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
<div class="overlay" id="tooltipOverlay">
    <div class="overlay-text" id="tooltipText"></div>
</div>
<script>
    const overlay = document.getElementById("tooltipOverlay");
    const overlayText = document.getElementById("tooltipText");

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

    document.getElementById('fetchDataR1').addEventListener("mouseenter", () => {
        const tooltipText = document.getElementById('fetchDataR1').getAttribute("data-tooltip");
        overlayText.textContent = tooltipText;

        // Activer l'overlay
        overlay.classList.add("active");
        document.body.classList.add("blurred"); // Appliquer l'effet de flou

        // Après 5 secondes, désactiver l'overlay et retirer le flou
        setTimeout(() => {
            overlay.classList.remove("active");
            document.body.classList.remove("blurred");
        }, 5000); // 5000ms = 5 secondes
    });


</script>
</body>
</html>
