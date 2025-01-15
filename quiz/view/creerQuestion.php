<?php
include_once __DIR__ . "/../autoloader/autoloader.php";
include_once __DIR__ . "/../provider/provider.php";

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un quiz</title>
</head>
<body>
    <p>Création d'un quiz</p>
    <?php
    $quizFactory = new creation\QuizFactory($pdo);
    $quizFactory->createQuestion();
    ?>
</body>
</html>
