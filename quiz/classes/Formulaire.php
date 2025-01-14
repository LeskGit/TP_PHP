<?php

namespace classes;
use dataObjects\Question;
use handler\QuestionHandler;

class Formulaire {

    public static function afficheFormulaire($idQuiz) {
        $html = '';
        $html .= '<h1>Formulaire</h1>';
        $questions = Question::selectQuestionByQuiz($idQuiz);

        $formulaire = handler\QuestionHandler::render($questions);

        $html .= $formulaire;
        echo $html;
    }
}
