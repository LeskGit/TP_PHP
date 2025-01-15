-- Insertion du quiz
INSERT INTO QUIZ (id, nom, description) VALUES (1, 'Quiz 1', 'Description du quiz 1');

-- Insertion des questions (type radio)
INSERT INTO QUESTION (id, question, type, score, quiz_id)
VALUES (1, 'Quelle est la couleur du ciel ?', 'radio', 100, 1);

-- Insertion des réponses pour la question 'radio'
INSERT INTO REPONSE (id, reponse, correct, question_id)
VALUES (1, 'Bleu', 1, 1),
       (2, 'Rouge', 0, 1),
       (3, 'Vert', 0, 1);


-- Insertion du quiz
INSERT INTO QUIZ (id, nom, description) VALUES (2, 'Quiz 2', 'Description du quiz 2');

-- Insertion des questions (type checkbox)
INSERT INTO QUESTION (id, question, type, score, quiz_id)
VALUES (2, 'Quelles couleurs sont présentes sur le drapeau français ?', 'checkbox', 100, 2);

-- Insertion des réponses pour la question 'checkbox'
INSERT INTO REPONSE (id, reponse, correct, question_id)
VALUES (4, 'Bleu', 1, 2),
       (5, 'Blanc', 1, 2),
       (6, 'Rouge', 1, 2),
       (7, 'Vert', 0, 2);


-- Insertion du quiz
INSERT INTO QUIZ (id, nom, description) VALUES (3, 'Quiz 3', 'Description du quiz 3');

-- Insertion des questions (type text)
INSERT INTO QUESTION (id, question, type, score, quiz_id)
VALUES (3, 'Quel est le nom du président de la France ?', 'text', 100, 3);

-- Pas de réponses pour la question 'text' car c'est une réponse libre
