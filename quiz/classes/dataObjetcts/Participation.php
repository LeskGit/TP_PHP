<?php
namespace dataObjects;

class Paricipation{

    public static function insert($pdo, $id, $pseudo, $score, $quiz_id){
        $query = $pdo->prepare("INSERT INTO participation (id, pseudo, score, quiz_id) VALUES (:id, :pseudo, :score, :quiz_id)");
        $query->execute([
            'id' => $id,
            'pseudo' => $pseudo,
            'score' => $score,
            'quiz_id' => $quiz_id
        ]);
    }

    public static function update($pdo, $id, $pseudo, $score, $quiz_id){
        $query = $pdo->prepare("UPDATE participation SET pseudo = :pseudo, score = :score, quiz_id = :quiz_id WHERE id = :id");
        $query->execute([
            'id' => $id,
            'pseudo' => $pseudo,
            'score' => $score,
            'quiz_id' => $quiz_id
        ]);
    }

    public static function delete($pdo, $id){
        $query = $pdo->prepare("DELETE FROM participation WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
    }

    public static function select($pdo, $id){
        $query = $pdo->prepare("SELECT * FROM participation WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public static function selectAll($pdo){
        $query = $pdo->query("SELECT * FROM participation");
        return $query->fetchAll();
    }
}
