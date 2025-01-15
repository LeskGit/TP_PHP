<?php
use dataObjects\Question;
use handler\QuestionHandler;

class Formulaire {

    public static function afficheFormulaire($pdo, $idQuiz) {
        $html = '';
        $html .= '<h1>Formulaire</h1>';
        $questions = Question::selectQuestionByQuiz($pdo, $idQuiz);

        $formulaire = QuestionHandler::render($questions);

        $html .= $formulaire;
        echo $html;
    }
}
