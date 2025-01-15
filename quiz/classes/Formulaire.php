<?php
namespace classes;
use dataObjects\Question;
use handler\QuestionHandler;

include_once __DIR__ . "/../classes/dataObjects/Question.php";
include_once __DIR__ . "/../classes/handler/QuestionHandler.php";


class Formulaire {

    public static function afficheFormulaire($pdo, $idQuiz) {
        $html = '';
        $html .= '<h1>Formulaire</h1>';
        $questions = Question::selectQuestionByQuiz($pdo, $idQuiz);
        foreach ($questions as $question) {
            echo htmlspecialchars($question['question']);
        }

        $formulaire = QuestionHandler::render($pdo, $questions);

        $html .= $formulaire;
        echo $html;
    }
}