<?php
// page pour gérer la redirection et l'ajout de la participation à la BD
use handler\QuizHandler;
include_once __DIR__ . "/../provider/provider.php";
include_once __DIR__ . "/../classes/handler/QuizHandler.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    QuizHandler::createParticipation($pdo, $_POST["idQuiz"], $_POST["score"], $_POST["pseudo"]);
    header('Location: classement.php');  // Redirige vers la page 'classement.php'
    exit;  // Arrête l'exécution du script pour éviter l'envoi de contenu supplémentaire
}
