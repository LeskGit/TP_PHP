<?php
include_once __DIR__ . "/../autoloader/autoloader.php";
include_once __DIR__ . "/../provider/provider.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Classement</title>
</head>
<body>
    <div id="classement">
        <h1>Classement</h1>
        <table>
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Nom</th>
                    <th>Score</th>
                    <th>Quiz</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $classement = dataObjects\Participation::selectWithQuizOrdered($pdo);
                $position = 1;
                foreach($classement as $joueur){
                    echo "<tr>";
                    echo "<td>" . $position . "</td>";
                    echo "<td>" . $joueur['pseudo'] . "</td>";
                    echo "<td>" . $joueur['score'] . "</td>";
                    echo "<td>" . $joueur['nomQuiz'] . "</td>";
                    echo "</tr>";
                    $position++;
                }
                ?>
            </tbody>
    </div>
</body>
</html>
