<?php
// cette classe gère les appèles de données sur la table Question et Reponse
namespace dataObjects;

class Questtion {
    public static function insert($pdo, $id, $question, $type, $score, $quiz_id){
        $query = $pdo->prepare("INSERT INTO QUESTION (id, question, type, score, quiz_id) VALUES (:id, :question, :type, :score, :quiz_id)");
        $query->execute([
            'id' => $id,
            'question' => $question,
            'type' => $type,
            'score' => $score,
            'quiz_id' => $quiz_id
        ]);
    }

    public static function insertAll($pdo, $questions){
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
        $query = $pdo->prepare("DELETE FROM QUESTION WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
    }

    public static function select($pdo, $id){
        $query = $pdo->prepare("SELECT * FROM QUESTION WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public static function selectAll($pdo){
        $query = $pdo->query("SELECT * FROM QUESTION");
        return $query->fetchAll();
    }

    public static function selectResponses($pdo, $question_id){
        // récupération des réponses liés à la question
        $query = $pdo->prepare("SELECT * FROM REPONSE WHERE question_id = :question_id");
        $query->execute([
            'questionId' => $question_id
        ]);
        return $query->fetch();
    }

    public static function selectCorrectRespones($pdo, $question_id){
        // récupération des réponses correctes liés à la question
        $query = $pdo->prepare("SELECT * FROM REPONSE WHERE question_id = :question_id AND correct = 1");
        $query->execute([
            'questionId' => $question_id
        ]);
        return $query->fetch();
    }

    public static function insertResponse($pdo, $id, $reponse, $isCorrect, $question_id){
        $query = $pdo->prepare("INSERT INTO REPONSE (id, reponse, isCorrect, question_id) VALUES (:id, :reponse, :isCorrect, :question_id)");
        $query->execute([
            'id' => $id,
            'reponse' => $reponse,
            'isCorrect' => $isCorrect,
            'question_id' => $question_id
        ]);
    }
}
