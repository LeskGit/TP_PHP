<?php
namespace handler;

use dataObjects\Question;

class AnswerHandler {

    // Variables globales pour le score total et le score utilisateur
    private static $totalScore = 0;
    private static $userScore = 0;

    public static function render($pdo, array $resultat, $idQuiz) {
        $html = '';


        $questions = Question::selectQuestionByQuiz($pdo, $idQuiz);

        $html .= '<ul class="list-group">';

        foreach ($questions as $question) {
            switch ($question['type']) {
                case 'text':
                    $html .= self::textHandler($pdo, $question, $resultat);
                    break;
                case 'radio':
                    $html .= self::radioHandler($pdo, $question, $resultat);
                    break;
                case 'checkbox':
                    $html .= self::checkboxHandler($pdo, $question, $resultat);
                    break;
            }
        }

        $html .= '</ul>';

        $html .= "<h5 class='mt-4'>Score de l'utilisateur : " . round(self::$userScore) . " / " . self::$totalScore . "</h5>";

        return $html;
    }

    private static function textHandler($pdo, $question, $resultat) {
        $html = "<li class='list-group-item mb-3'><strong>" . htmlspecialchars($question['question']) . " :</strong> ";
        $reponse = isset($resultat[$question['id']]) ? $resultat[$question['id']] : '';

        // Validation de la réponse
        $correctAnswers = Question::selectCorrectRespones($pdo, $question['id']);
        if ($reponse && strcasecmp($correctAnswers[0]["reponse"], $reponse) == 0) {
            self::$userScore += $question['score'];
            $html .= "<div class='alert alert-success'>" . htmlspecialchars($reponse) . "</div>";
        } else {
            $html .= "<div class='alert alert-danger'>" . htmlspecialchars($reponse) . "</div>";
        }

        $html .= "</li>";

        $html .= "<p>" . 'La bonne réponse était : ' . '<strong>' . htmlspecialchars($correctAnswers[0]["reponse"]) . '</strong>' . "</p>";
        self::$totalScore += $question['score'];

        return $html;
    }

    private static function radioHandler($pdo, $question, $resultat) {
        $html = "<li class='list-group-item mb-3'><strong>" . htmlspecialchars($question['question']) . " :</strong> ";
        $reponse_id = isset($resultat[$question['id']]) ? $resultat[$question['id']] : '';
        $temp = Question::selectResponseById($pdo, $question['id'], $reponse_id);
        $reponse = $temp[0]["reponse"];

        $correctAnswers = Question::selectCorrectRespones($pdo, $question['id']);
        if ($reponse_id && in_array($reponse_id, array_column($correctAnswers, 'id'))) {
            self::$userScore += $question['score'];
            $html .= "<div class='alert alert-success'>" . htmlspecialchars($reponse) . "</div>";
        } else {
            $html .= "<div class='alert alert-danger'>" . htmlspecialchars($reponse) . "</div>";
        }

        $html .= "</li>";
        $html .= "<p>" . 'La bonne réponse était : ' . '<strong>' . htmlspecialchars($correctAnswers[0]["reponse"]) . '</strong>' . "</p>";
        self::$totalScore += $question['score'];

        return $html;
    }

    private static function checkboxHandler($pdo, $question, $resultat) {
        $html = "<li class='list-group-item mb-3'><strong>" . htmlspecialchars($question['question']) . " :</strong> ";

        // Récupérer les bonnes réponses
        $correctAnswers = Question::selectCorrectRespones($pdo, $question['id']);
        $correctAnswerIds = array_map(function ($answer) {
            return $answer['id'];
        }, $correctAnswers);

        $reponse_ids = isset($resultat[$question['id']]) ? $resultat[$question['id']] : [];
        $selectionAnswers = [];
        foreach ($reponse_ids as $reponse_id) {
            $temp = Question::selectResponseById($pdo, $question['id'], $reponse_id);
            if (!empty($temp)) {
                $reponse = $temp[0];
                array_push($selectionAnswers, $reponse);
            }
        }

        $nb_reponse_correct = count($correctAnswers);
        $nb_reponse_coherente = 0;

        foreach ($selectionAnswers as $selectionAnswer) {
            if (in_array($selectionAnswer['id'], $correctAnswerIds)) {
                $nb_reponse_coherente++;
                self::$userScore += $question['score'] / $nb_reponse_correct;
                $html .= "<div class='alert alert-success'>" . htmlspecialchars($selectionAnswer['reponse']) . "</div>";
            } else {
                $html .= "<div class='alert alert-danger'>" . htmlspecialchars($selectionAnswer['reponse']) . "</div>";
            }
        }

        $html .= "</li>";
        self::$totalScore += $question['score'];

        return $html;
    }
}
