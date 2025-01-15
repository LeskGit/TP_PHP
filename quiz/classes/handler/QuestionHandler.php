<?php
namespace handler;

use dataObjects\Question;

/**
 * Classe permettant de gérer tous les types de questions
 */

class QuestionHandler {

    /**
     * Génère le HTML de la question
     *
     * @param array $question La question à afficher
     * @return string Le code HTML de la question
     */
    public static function render($pdo, array $questions) {
        $html = '';
        $html .= '<form class="form-container" method="POST">';
        foreach ($questions as $question) {
            switch ($question['type']) {
                case 'text':
                    $html .= self::textHandler($pdo, $question);
                    break;
                case 'radio':
                    $html .= self::radioHandler($pdo, $question);
                    break;
                case 'checkbox':
                    $html .= self::checkboxHandler($pdo, $question);
                    break;
            }
        }
        $html .= '<div class="form-group text-center">';
        $html .= '<button type="submit" class="btn btn-primary btn-lg">Submit</button>';
        $html .= '</div>';
        $html .= '</form>';
        return $html;
    }

    public static function textHandler($pdo, $question): string {
        $html = '<div class="form-group mb-4">';
        $html .= '<label for="question_' . $question['id'] . '" class="form-label"><h5>' . htmlspecialchars($question['question']) . '</h5></label>';
        $html .= '<input type="text" name="' . $question['id'] . '" id="' . $question['id'] . '" class="form-control" placeholder="Votre réponse">';
        $html .= '</div>';
        return $html;
    }

    public static function radioHandler($pdo, $question): string {
        $choices = Question::selectResponses($pdo, $question['id']);
        $html = '<div class="form-group mb-4">';
        $html .= '<h5>' . htmlspecialchars($question['question']) . '</h5>';
        foreach ($choices as $choice) {
            $html .= '<div class="form-check">';
            $html .= '<input class="form-check-input" type="radio" name="' . $question['id'] . '" id="' . $choice['id'] . '" value="' . $choice['id'] . '">';
            $html .= '<label class="form-check-label" for="choice_' . $choice['id'] . '">' . htmlspecialchars($choice['reponse']) . '</label>';
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }

    public static function checkboxHandler($pdo, $question): string {
        $choices = Question::selectResponses($pdo, $question['id']);
        $html = '<div class="form-group mb-4">';
        $html .= '<h5>' . htmlspecialchars($question['question']) . '</h5>';
        foreach ($choices as $choice) {
            $html .= '<div class="form-check">';
            $html .= '<input type="checkbox" class="form-check-input" name="' . $question['id'] . '[]" id="' . $choice['id'] . '" value="' . $choice['id'] . '">';
            $html .= '<label class="form-check-label" for="' . $choice['id'] . '">' . htmlspecialchars($choice['reponse']) . '</label>';
            $html .= '</div>';
        }
        $html .= '</div>';
        return $html;
    }
}