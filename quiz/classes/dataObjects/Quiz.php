<?php

// cette classe gère les appèles de données sur la table Quiz
namespace dataObjects;

class Quiz {

    public static function insert($pdo, $nom, $description){
        // insertion d'un quiz
        $query = $pdo->query("SELECT MAX(id) as id FROM QUIZ");
        $id = $query->fetch()['id'] + 1;
        $query = $pdo->prepare("INSERT INTO QUIZ (id, nom, description) VALUES (:id, :nom, :description)");
        $query->execute([
            'id' => $id,
            'nom' => $nom,
            'description' => $description
        ]);
    }

    public static function update($pdo, $id, $nom, $description){
        // mise à jour d'un quiz
        $query = $pdo->prepare("UPDATE QUIZ SET nom = :nom, description = :description WHERE id = :id");
        $query->execute([
            'id' => $id,
            'nom' => $nom,
            'description' => $description
        ]);
    }

    public static function delete($pdo, $id){
        // suppression d'un quiz
        $query = $pdo->prepare("DELETE FROM QUIZ WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
    }

    public static function select($pdo, $id){
        // selection d'un quiz
        $query = $pdo->prepare("SELECT * FROM QUIZ WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
        return $query->fetch();
    }

    public static function selectAll($pdo){
        // selection de tous les quiz
        $query = $pdo->query("SELECT * FROM QUIZ");
        return $query->fetchAll();
    }
}
