<?php
namespace dataObjects;

class Paricipation implements dataObjects\BdObjects{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function insert($id, $pseudo, $score, $quiz_id){
        $query = $this->pdo->prepare("INSERT INTO participation (id, pseudo, score, quiz_id) VALUES (:id, :pseudo, :score, :quiz_id)");
        $query->execute([
            'id' => $id,
            'pseudo' => $pseudo,
            'score' => $score,
            'quiz_id' => $quiz_id
        ]);
    }

    public function update($id, $pseudo, $score, $quiz_id){
        $query = $this->pdo->prepare("UPDATE participation SET pseudo = :pseudo, score = :score, quiz_id = :quiz_id WHERE id = :id");
        $query->execute([
            'id' => $id,
            'pseudo' => $pseudo,
            'score' => $score,
            'quiz_id' => $quiz_id
        ]);
    }

    public function delete($id){
        $query = $this->pdo->prepare("DELETE FROM participation WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
    }

    public function select($id){
        $query = $this->pdo->prepare("SELECT * FROM participation WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public function selectAll(){
        $query = $this->pdo->query("SELECT * FROM participation");
        return $query->fetchAll();
    }
}
