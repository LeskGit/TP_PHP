-- insertion des quizs
INSERT INTO QUIZ (id, nom, description) VALUES (1, 'Quiz 1', 'Description du quiz 1');

-- insertion des questions
INSERT INTO QUESTION (id, question, type, score, quiz_id) VALUES (1, 'Question 1', 'text', 100, 1);

-- insertion des réponses
INSERT INTO REPONSE (id, reponse, correct, question_id) VALUES (1, 'xiaopang', true, 1);

-- insertion des participations
INSERT INTO PARTICIPATION (id, pseudo, score, quiz_id) VALUES
    (1, "le boss", 200, 1),
    (2, "Axel", 100, 1),
    (3, "CocoCaca", 50, 1);