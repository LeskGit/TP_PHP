<?php
namespace view;

use classes\Formulaire;

include_once __DIR__ . "/../provider/provider.php";
include_once __DIR__ . "/../classes/Formulaire.php";

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Simple avec Bootstrap</title>
    <!-- Lien vers le CDN de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- En-tête -->
<header class="bg-dark text-white text-center py-3">
    <h1>Bienvenue sur ma page</h1>
</header>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Mon Site</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">À propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Section principale -->
<main class="container mt-4">
    <?php
    // Vérifier si l'ID est passé dans l'URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];  // Récupère l'ID du quiz depuis l'URL

        Formulaire::afficheFormulaire($pdo, $id);
    } else {
        echo "<p>Aucun quiz sélectionné.</p>";
    }
    ?>

</main>

<!-- Pied de page -->
<footer class="bg-dark text-white text-center py-3 mt-4">
    <p>&copy; 2025 Mon Site Web</p>
</footer>

<!-- Lien vers le script Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>