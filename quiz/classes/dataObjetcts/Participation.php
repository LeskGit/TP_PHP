<?php
// cette classe gère les appèles de données sur la table Participation
namespace dataObjects;

class Paricipation{

    public static function insert($pdo, $id, $pseudo, $score, $quiz_id){
        $query = $pdo->prepare("INSERT INTO PARTICIPATION (id, pseudo, score, quiz_id) VALUES (:id, :pseudo, :score, :quiz_id)");
        $query->execute([
            'id' => $id,
            'pseudo' => $pseudo,
            'score' => $score,
            'quiz_id' => $quiz_id
        ]);
    }

    public static function update($pdo, $id, $pseudo, $score, $quiz_id){
        $query = $pdo->prepare("UPDATE PARTICIPATION SET pseudo = :pseudo, score = :score, quiz_id = :quiz_id WHERE id = :id");
        $query->execute([
            'id' => $id,
            'pseudo' => $pseudo,
            'score' => $score,
            'quiz_id' => $quiz_id
        ]);
    }

    public static function delete($pdo, $id){
        $query = $pdo->prepare("DELETE FROM PARTICIPATION WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
    }

    public static function select($pdo, $id){
        $query = $pdo->prepare("SELECT * FROM PARTICIPATION WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public static function selectAll($pdo){
        $query = $pdo->query("SELECT * FROM PARTICIPATION");
        return $query->fetchAll();
    }
}
