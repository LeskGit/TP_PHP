<?php
// cette classe gère les appèles de données sur la table Question et Reponse
namespace dataObjects;

class Question {
    public static function insert($pdo, $question, $type, $score, $quiz_id){
        // inssertion d'une question*
        $query = $pdo->query("SELECT MAX(id) as id FROM QUESTION");
        $id = $query->fetch()['id'] + 1;
        $query = $pdo->prepare("INSERT INTO QUESTION (id, question, type, score, quiz_id) VALUES (:id, :question, :type, :score, :quiz_id)");
        $query->execute([
            'id' => $id,
            'question' => $question,
            'type' => $type,
            'score' => $score,
            'quiz_id' => $quiz_id
        ]);
        return $id;
    }

    public static function insertAll($pdo, $questions){
        // insertion de plusieurs questions
        $query = $pdo->prepare("INSERT INTO QUESTION (id, question, type, score, quiz_id) VALUES (:id, :question, :type, :score, :quiz_id)");
        foreach($questions as $question){
            $query->execute([
                'id' => $question['id'],
                'question' => $question['question'],
                'type' => $question['type'],
                'score' => $question['score'],
                'quiz_id' => $question['quiz_id']
            ]);
        }
    }

    public static function update($pdo, $id, $question, $type, $score, $quiz_id){
        // mise à jour d'une question
        $query = $pdo->prepare("UPDATE QUESTION SET question = :question, type = :type, score = :score, quiz_id = :quiz_id WHERE id = :id");
        $query->execute([
            'id' => $id,
            'question' => $question,
            'type' => $type,
            'score' => $score,
            'quiz_id' => $quiz_id
        ]);
    }

    public static function delete($pdo, $id){
        // suppression d'une question
        $query = $pdo->prepare("DELETE FROM QUESTION WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
    }

    public static function select($pdo, $id){
        // selection d'une question
        $query = $pdo->prepare("SELECT * FROM QUESTION WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public static function selectQuestionByQuiz($pdo, $quiz_id){
        // selection d'une question
        $query = $pdo->prepare("SELECT * FROM QUESTION WHERE quiz_id = :quiz_id");
        $query->execute([
            'quiz_id' => $quiz_id
        ]);
        return $query->fetchAll();
    }

    public static function selectAll($pdo){
        // selection de toutes les questions
        $query = $pdo->query("SELECT * FROM QUESTION");
        return $query->fetchAll();
    }

    public static function selectResponses($pdo, $question_id){
        // récupération des réponses liés à la question
        $query = $pdo->prepare("SELECT * FROM REPONSE WHERE question_id = :question_id");
        $query->execute([
            'question_id' => $question_id
        ]);
        return $query->fetchAll();
    }

    public static function selectCorrectRespones($pdo, $id){
        // récupération des réponses correctes liés à la question
        $query = $pdo->prepare("SELECT * FROM REPONSE WHERE id = :id AND correct = 1");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetchAll();
    }

    public static function insertResponse($pdo, $reponse, $isCorrect, $question_id){
        // insertion d'une réponse
        $query = $pdo->query("SELECT MAX(id) as id FROM REPONSE");
        $id = $query->fetch()['id'] + 1;
        $query = $pdo->prepare("INSERT INTO REPONSE (id, reponse, correct, question_id) VALUES (:id, :reponse, :isCorrect, :question_id)");
        $query->execute([
            'id' => $id,
            'reponse' => $reponse,
            'isCorrect' => $isCorrect,
            'question_id' => $question_id
        ]);
    }
}