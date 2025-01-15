<?php
namespace creation;

class QuizFactory {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function createQuestion(){
        $state = $_POST['state'] ?? 'init';
        $this->renderCreateQuestionForm($state);
    }

    private function renderCreateQuestionForm($state){
        switch($state){
            case 'init':
                $this->renderCreateQuestionFormInit();
                break;
            case 'reponse':
                $this->saveQuestion();
                $this->renderCreateResponseForm();
                break;
            case 'saveRep':
                $this->saveResponse();
                break;
        }
    }

    private function renderCreateQuestionFormInit(){
        echo "<form method='post'>";
        echo "<label for='question'>Question:</label>";
        echo "<input type='text' name='question' id='question'>";
        echo "<label for='type'>Type:</label>";
        echo "<select name='type' id='type'>";
        echo "<option value='text'>Texte</option>";
        echo "<option value='radio'>Choix unique</option>";
        echo "<option value='checkbox'>Choix multiple</option>";
        echo "</select>";
        echo "<label for='score'>Score:</label>";
        echo "<input type='number' name='score' id='score'>";
        echo "<input type='hidden' name='state' value='reponse'>";
        echo "<input type='submit' value='suite'>";
        echo "</form>";
    }

    private function saveQuestion(){
        $question = $_POST['question'];
        $type = $_POST['type'];
        $score = $_POST['score'];
        $quiz_id = $_GET['id'];
        $id = \dataObjects\Question::insert($this->pdo, $question, $type, $score, $quiz_id);
        $_POST['question_id'] = $id;
        echo "Question créée!";
    }

    private function renderCreateResponseForm(){
        echo "<form method='post'>";
        switch ($_POST['type']){
            case 'text':
                $this->renderCreateResponseFormText();
                break;
            case 'radio':
                $this->renderCreateResponseFormRadio();
                break;
            case 'checkbox':
                $this->renderCreateResponseFormCheckbox();
                break;
        }
        echo "<input type='hidden' name='type' value='" . $_POST['type'] . "'>";
        echo "<input type='hidden' name='question_id' value='" . $_POST['question_id'] . "'>";
        echo "<input type='hidden' name='state' value='saveRep'>";
        echo "<input type='submit' value='valider'>";
        echo "</form>";
    }

    private function saveResponse(){
        switch ($_POST['type']){
            case 'text':
                $this->saveTextReponse();
                break;
            case 'radio':
                $this->saveRadioReponse();
                break;
            case 'checkbox':
                $this->saveCheckboxReponse();
                break;
        }
    }

    private function renderCreateResponseFormText(){
        echo "<label for='response'>Réponse:</label>";
        echo "<input type='text' name='response' id='response'>";
    }

    private function saveTextReponse(){
        $response = $_POST['response'];
        $question_id = $_POST['question_id'];
        \dataObjects\Question::insertResponse($this->pdo, $response, 1, $question_id);
        echo "Réponse créée!";
    }

    private function renderCreateResponseFormRadio(){
        for ($i = 0; $i < 4; $i++){
            echo "<div>";
            echo "<label for='response" . $i . "'>Réponse " . $i . ":</label>";
            echo "<input type='text' name='response" . $i . "' id='response" . $i . "'>";
            echo "<label for='correct" . $i . "'>Correct:</label>";
            echo "<input type='radio' name='correct' value='" . $i . "'>";
            echo "</div>";
        }
    }

    private function saveRadioReponse(){
        $question_id = $_POST['question_id'];
        for ($i = 0; $i < 4; $i++){
            $reponse = $_POST['response' . $i];
            $correct = $_POST['correct'] == $i ? 1 : 0;
            \dataObjects\Question::insertResponse($this->pdo, $reponse, $correct, $question_id);
        }
        echo "Réponses créées!";
    }

    private function renderCreateResponseFormCheckbox(){
        for ($i = 0; $i < 4; $i++){
            echo "<div>";
            echo "<label for='response" . $i . "'>Réponse " . $i . ":</label>";
            echo "<input type='text' name='response" . $i . "' id='response" . $i . "'>";
            echo "<label for='correct" . $i . "'>Correct:</label>";
            echo "<input type='checkbox' name='correct" . $i . "' value='" . $i . "'>";
            echo "<div/>";
        }
    }

    private function saveCheckboxReponse(){
        $question_id = $_POST['question_id'];
        for ($i = 0; $i < 4; $i++){
            $reponse = $_POST['response' . $i];
            $correct = $_POST['correct' . $i] == $i ? 1 : 0;
            \dataObjects\Question::insertResponse($this->pdo, $reponse, $correct, $question_id);
        }
        echo "Réponses créées!";
    }
}
