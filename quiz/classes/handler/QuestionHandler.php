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
    public static function render(array $questions) {
        $html = '';
        $html .= '<form action="/reponse.php">';
        foreach ($questions as $question) {
            switch ($question['type']) {
                case 'text':
                    $html .= self::textHandler($question);
                    break;
                case 'radio':
                    $html .= self::radioHandler($question);
                    break;
                case 'checkbox':
                    $html .= self::checkboxHandler($question);
                    break;
            }
        }
        $html .= '<button type="submit" class="btn btn-default">Submit</button>';
        $html .= '</form>';
        return $html;
    }

    public static function textHandler($question): string {
        $html = '<div class="form-group">';
        $html .= '<h2>' . htmlspecialchars($question['question']) . '</h2>';
        $html .= '<input type="text" name="question_' . $question['id'] . '">';
        $html .= '</div>';
        return $html;
    }

    public static function radioHandler($question): string {
        $choices = Question::selectResponses($question['id']);
        $html = '<div class="form-check">';
        $html .= '<h2>' . htmlspecialchars($question['question']) . '</h2>';
        foreach ($choices as $choice) {
            $html .= '<label class="form-check-label"><input class="form-check-input" type="radio" name="question_' . $question['id'] . '" value="' . $choice['id'] . '"> ' . htmlspecialchars($choice['reponse']) . '</label>';
        }
        $html .= '</div>';
        return $html;
    }

    public static function checkboxHandler($question): string {
        $choices = Question::selectResponses($question['id']);
        $html = '<div class="form-check">';
        $html .= '<h2>' . htmlspecialchars($question['question']) . '</h2>';
        foreach ($choices as $choice) {
            $html .= '<label class="form-check-label"><input type="checkbox" class="form-check-input" name="question_' . $question['id'] . '[]" value="' . $choice['id'] . '"> ' . htmlspecialchars($choice['reponse']) . '</label>';
        }
        $html .= '</div>';
        return $html;
    }

    
 }