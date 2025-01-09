<?php
namespace tools;

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
    public static function render(array $question): string {
        $html = '';
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
        echo $html;
    }

    public static function textHandler(array $question): string {
        $html = '<div class="question">';
        $html .= '<h2>' . htmlspecialchars($question['question']) . '</h2>';
        $html .= '<input type="text" name="question_' . $question['id'] . '">';
        $html .= '</div>';
        return $html;
    }

    public static function radioHandler(array $question): string {
        $html = '<div class="question">';
        $html .= '<h2>' . htmlspecialchars($question['question']) . '</h2>';
        foreach ($question['choices'] as $choice) {
            $html .= '<label><input type="radio" name="question_' . $question['id'] . '" value="' . $choice['id'] . '"> ' . htmlspecialchars($choice['choice']) . '</label>';
        }
        $html .= '</div>';
        return $html;
    }

    public static function checkboxHandler(array $question): string {
        $html = '<div class="question">';
        $html .= '<h2>' . htmlspecialchars($question['question']) . '</h2>';
        foreach ($question['choices'] as $choice) {
            $html .= '<label><input type="checkbox" name="question_' . $question['id'] . '[]" value="' . $choice['id'] . '"> ' . htmlspecialchars($choice['choice']) . '</label>';
        }
        $html .= '</div>';
        return $html;
    }

    
 }