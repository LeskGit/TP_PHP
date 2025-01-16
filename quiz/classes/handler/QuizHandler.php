<?php
namespace handler;
use \dataObjects\Question;
use \handler\QuestionHandler;
use \handler\AnswerHandler;
use \dataObjects\Participation;
use PDOException;

include_once __DIR__ . "/../dataObjects/Question.php";
include_once __DIR__ . "/../dataObjects/Participation.php";
include_once __DIR__ . "/QuestionHandler.php";
include_once __DIR__ . "/AnswerHandler.php";

/**
 * Gère le quiz en terme de question et réponse + correction
 */
class QuizHandler {

    /**
     * @param $pdo
     * @param $idQuiz
     * @return void
     *
     * Affiche le formulaire (questions) correspondant au quiz en faisant appel au Handler
     */
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

    /**
     * @param $pdo
     * @param $idQuiz
     * @return void
     *
     * Affiche les réponse aux question soumis avec leur correction (score...)
     */
    public static function afficheReponses($pdo, $idQuiz) {
        $html = '';
        echo "<h1>Correction :</h1>";
        $resultat = [];

        // On parcours les clé valeurs (id_question => reponse_id) afin d'avoir un tableau pour gérer les résultats
        foreach ($_POST as $question_id => $response_id) {
            $resultat[$question_id] = $response_id;
        }

        // On envoie les résultat aux handler
        $correction = AnswerHandler::render($pdo, $resultat, $idQuiz);
        $html .= $correction;
        echo $html;
    }

    /**
     * @param $pdo
     * @param $idQuiz
     * @param $score
     * @param $pseudo
     * @return void
     *
     * Permet d'enregistrer, via le formulaire apres avoir soumis nos reponse aux quiz, notre score avec pseudo dans la BD pour le classement
     */
    public static function createParticipation($pdo, $idQuiz, $score, $pseudo) {
        try {
            Participation::insert($pdo, $pseudo, $score, $idQuiz);
            echo "Mis a jour du classement effectué avec succès.";
        } catch (PDOException $e) {
            error_log("Erreur lors de la création de la participation : " . $e->getMessage());
            echo "Une erreur est survenue lors de la création de la participation.";
        }
    }


}