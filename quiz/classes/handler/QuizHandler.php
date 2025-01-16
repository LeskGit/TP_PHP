<?php
namespace handler;
use \dataObjects\Question;
use \handler\QuestionHandler;
use \handler\AnswerHandler;

include_once __DIR__ . "/../dataObjects/Question.php";
include_once __DIR__ . "/QuestionHandler.php";
include_once __DIR__ . "/AnswerHandler.php";


class QuizHandler {

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

    public static function afficheReponses($pdo, $idQuiz) {
        $html = '';
        echo "<h1>Correction :</h1>";
        $resultat = [];

        foreach ($_POST as $question_id => $response_id) {
            $resultat[$question_id] = $response_id;
        }

        $correction = AnswerHandler::render($pdo, $resultat, $idQuiz);
        $html .= $correction;
        echo $html;
    }

}