<?php
include_once __DIR__ . "/../autoloader/autoloader.php";
include_once __DIR__ . "/../provider/provider.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
</head>
<body>
    <h1>Quiz</h1>
    <p>Voici la liste des quiz disponibles:</p>
    <ul>
        <?php
        $quizs = dataObjects\Quiz::selectAll($pdo);  // Récupère tous les quiz
        foreach($quizs as $quiz){
            // Crée un lien vers quiz.php avec l'ID du quiz dans l'URL
            echo "<li><a href='quiz.php?id=" . $quiz['id'] . "'>" . $quiz['nom'] . "</a></li>";
        }

        ?>
    </ul>
</body>
</html>
