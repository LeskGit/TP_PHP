<?php
namespace handler;

use dataObjects\Question;

/**
 * Classe permettant de gérer les réponse soumis aux question du quiz + afficahge et score
 */
class AnswerHandler {

    // Variables globales pour le score total et le score utilisateur
    private static $totalScore = 0;
    private static $userScore = 0;

    /**
     * @param $pdo
     * @param array $resultat
     * @param $idQuiz
     * @return string
     */
    public static function render($pdo, array $resultat, $idQuiz) {
        $html = '';


        $questions = Question::selectQuestionByQuiz($pdo, $idQuiz);

        $html .= '<ul class="list-group">';

        // On gère les questions une par une selon leurs types
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

        // Ajout du formulaire pour l'enregistrement
        $html .= '<form class="mt-4" method="post" action="save_participation.php">';
            $html .= '<div class="form-group">';
                $html .= '<label for="pseudo">Votre pseudo :</label>';
                $html .= '<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Entrez votre pseudo" required>';
                $html .= '</div>';
                $html .= '<div class="form-check">';
            $html .= '</div>';
            $html .= '<input type="hidden" name="idQuiz" value="' . htmlspecialchars($idQuiz) . '">';
            $html .= '<input type="hidden" name="score" value="' . htmlspecialchars(round(self::$userScore)) . '">';
            $html .= '<button type="submit" class="btn btn-primary mt-3">Soumettre</button>';
        $html .= '</form>';
        return $html;
    }

    /**
     * @param $pdo
     * @param $question
     * @param $resultat
     * @return string
     */
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

    /**
     * @param $pdo
     * @param $question
     * @param $resultat
     * @return string
     */
    private static function radioHandler($pdo, $question, $resultat) {
        $html = "<li class='list-group-item mb-3'><strong>" . htmlspecialchars($question['question']) . " :</strong> ";
        $reponse_id = isset($resultat[$question['id']]) ? $resultat[$question['id']] : '';
        $temp = Question::selectResponseById($pdo, $question['id'], $reponse_id);
        $reponse = $temp[0]["reponse"];

        $correctAnswers = Question::selectCorrectRespones($pdo, $question['id']);

        // Une seule réponse possible car radio (on vérifie sans passer par un foreach)
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

    /**
     * @param $pdo
     * @param $question
     * @param $resultat
     * @return string
     */
    private static function checkboxHandler($pdo, $question, $resultat) {
        $html = "<li class='list-group-item mb-3'><strong>" . htmlspecialchars($question['question']) . " :</strong> ";

        // Récupérer les bonnes réponses
        $correctAnswers = Question::selectCorrectRespones($pdo, $question['id']);
        $correctAnswerIds = array_map(function ($answer) {
            return $answer['id'];
        }, $correctAnswers);

        $reponse_ids = isset($resultat[$question['id']]) ? $resultat[$question['id']] : [];
        $selectionAnswers = [];

        // Permet d'avoir les réponses soumise en clair (pas dans une liste de liste)
        foreach ($reponse_ids as $reponse_id) {
            $temp = Question::selectResponseById($pdo, $question['id'], $reponse_id);
            if (!empty($temp)) {
                $reponse = $temp[0];
                array_push($selectionAnswers, $reponse);
            }
        }

        $nb_reponse_correct = count($correctAnswers);
        $nb_reponse_coherente = 0;

        // Vérification des réponse soumise par rapport aux bonne réponse
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
