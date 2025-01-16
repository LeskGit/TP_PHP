<?php
namespace creation;
// cette classe gère la création de quiz
class QuizFactory {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    /**
     * construction d'un formulaire de création de quiz
     */
    public function createQuiz(){
        if (isset($_POST['nom']) && isset($_POST['description'])){
            \dataObjects\Quiz::insert($this->pdo, $_POST['nom'], $_POST['description']);
            echo "Quiz créé!";
        } else {
            $this->renderCreateQuizForm($state);
        }
    }

    /**
     * rendu du formulaire de création de quiz
     */
    private function renderCreateQuizForm(){
        echo "<form method='post'>";
        echo "<div>";
        echo "<label for='nom'>Nom:</label>";
        echo "<input type='text' name='nom' id='nom'>";
        echo "</div>";
        echo "<div>";
        echo "<label for='description'>Description:</label>";
        echo "<input type='text' name='description' id='description'>";
        echo "</div>";
        echo "<input type='submit' value='Créer'>";
        echo "</form>";
    }
}
