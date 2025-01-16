<?php
namespace view;

use \handler\QuizHandler;

include_once __DIR__ . "../../provider/provider.php";
include_once __DIR__ . "/../classes/handler/QuizHandler.php";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Quiz</title>
    <!-- Lien vers le CDN de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- En-tête -->
<header class="bg-dark text-white text-center py-3">
    <h1>Bienvenue sur ma page de Quiz</h1>
</header>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Mon Site</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Accueil</a>
                </li>
        </div>
    </div>
</nav>

<!-- Section principale -->
<main class="container mt-4">
    <?php
    // On vérif si on a bien récuperer l'ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        // lien vers la création d'une question
        echo "<div><a href='creerQuestion.php?id=" . $id . "'>Créer une question</a><div/>";


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Si la méthode est POST, afficher les réponses
            QuizHandler::afficheReponses($pdo, $id);
        } else {
            // Si la méthode est GET, afficher le formulaire
            QuizHandler::afficheFormulaire($pdo, $id);
        }
    // Vérifier si l'ID est passé dans l'URL

    } else {
        echo "<p>Aucun quiz sélectionné.</p>";
    }
    ?>
</main>

<!-- Pied de page -->
<footer class="bg-dark text-white text-center py-3 mt-4">
    <p>&copy; 2025 mon quiz</p>
</footer>

<!-- Lien vers le script Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
