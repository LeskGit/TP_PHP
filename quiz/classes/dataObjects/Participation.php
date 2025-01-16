<?php
// cette classe gère les appèles de données sur la table Participation
namespace dataObjects;

class Participation{

    public static function insert($pdo, $pseudo, $score, $quiz_id){
        // Insertion d'une participation
        $query = $pdo->prepare("INSERT INTO PARTICIPATION (pseudo, score, quiz_id) VALUES (:pseudo, :score, :quiz_id)");
        $query->execute([
            'pseudo' => $pseudo,
            'score' => $score,
            'quiz_id' => $quiz_id
        ]);
    }


    public static function update($pdo, $id, $pseudo, $score, $quiz_id){
        // mise à jour d'une participation
        $query = $pdo->prepare("UPDATE PARTICIPATION SET pseudo = :pseudo, score = :score, quiz_id = :quiz_id WHERE id = :id");
        $query->execute([
            'id' => $id,
            'pseudo' => $pseudo,
            'score' => $score,
            'quiz_id' => $quiz_id
        ]);
    }

    public static function delete($pdo, $id){
        // suppression d'une participation
        $query = $pdo->prepare("DELETE FROM PARTICIPATION WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
    }

    public static function select($pdo, $id){
        // selection d'une participation
        $query = $pdo->prepare("SELECT * FROM PARTICIPATION WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public static function selectAll($pdo){
        // selection de toutes les participations
        $query = $pdo->query("SELECT * FROM PARTICIPATION");
        return $query->fetchAll();
    }

    public static function selectByQuiz($pdo, $quiz_id){
        // selection de toutes les participations pour un quiz donné
        $query = $pdo->prepare("SELECT * FROM PARTICIPATION WHERE quiz_id = :quiz_id ORDER BY score DESC");
        $query->execute([
            'quiz_id' => $quiz_id
        ]);
        return $query->fetchAll();
    }

    public static function selectByPseudo($pdo, $pseudo){
        // selection de toutes les participations pour un pseudo donné
        $query = $pdo->prepare("SELECT * FROM PARTICIPATION WHERE pseudo = :pseudo ORDER BY score DESC");
        $query->execute([
            'pseudo' => $pseudo
        ]);
        return $query->fetchAll();
    }

    public static function selectByPseudoAndQuiz($pdo, $pseudo, $quiz_id){
        // selection de toutes les participations pour un pseudo et un quiz donné
        $query = $pdo->prepare("SELECT * FROM PARTICIPATION WHERE pseudo = :pseudo AND quiz_id = :quiz_id ORDER BY score DESC");
        $query->execute([
            'pseudo' => $pseudo,
            'quiz_id' => $quiz_id
        ]);
        return $query->fetchAll();
    }

    public static function selectWithQuizOrdered($pdo){
        // selection de toutes les participations avec le quiz associé
        $query = $pdo->query("SELECT pseudo, score, nom as nomQuiz FROM PARTICIPATION JOIN QUIZ ON PARTICIPATION.quiz_id = QUIZ.id ORDER BY score DESC");
        return $query->fetchAll();
    }
}
