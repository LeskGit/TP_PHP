<?php

// cette classe gère les appèles de données sur la table Quiz
namespace dataObjects;

class Quiz {
    public static function insert($pdo, $id, $nom, $description){
        $query = $pdo->prepare("INSERT INTO QUIZ (id, nom, description) VALUES (:id, :nom, :description)");
        $query->execute([
            'id' => $id,
            'nom' => $nom,
            'description' => $description
        ]);
    }

    public static function update($pdo, $id, $nom, $description){
        $query = $pdo->prepare("UPDATE QUIZ SET nom = :nom, description = :description WHERE id = :id");
        $query->execute([
            'id' => $id,
            'nom' => $nom,
            'description' => $description
        ]);
    }

    public static function delete($pdo, $id){
        $query = $pdo->prepare("DELETE FROM QUIZ WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
    }

    public static function select($pdo, $id){
        $query = $pdo->prepare("SELECT * FROM QUIZ WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public static function selectAll($pdo){
        $query = $pdo->query("SELECT * FROM QUIZ");
        return $query->fetchAll();
    }
}
