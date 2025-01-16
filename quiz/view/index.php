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
    <div>
        <a href="classement.php">lien vers le classement</a>
    </div>
    <div>
        <a href="creerQuiz.php">lien vers la création d'un quiz</a>
    </div>
    <p>Voici la liste des quiz disponibles:</p>
    <ul>
        <?php
        $quizs = dataObjects\Quiz::selectAll($pdo);
        foreach($quizs as $quiz){
            echo "<li><a href='quiz.php?id=" . $quiz['id'] . "'>" . $quiz['nom'] . "</a></li>";
        }
        ?>
    </ul>
</body>
</html>
