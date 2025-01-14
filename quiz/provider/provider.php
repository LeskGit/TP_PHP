<?php
try {
    echo "Tentative de connexion à la base de données...<br>";
    echo "sqlite:" . __DIR__ . "/../../database/quiz.sqlite";
    $pdo = new PDO("sqlite:" . __DIR__ . "/../database/quiz.sqlite");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Connection échouée: " . $e->getMessage();
}
