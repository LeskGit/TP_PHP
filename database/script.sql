CREATE TABLE PARTICIPATION (
    id INTEGER PRIMARY KEY,
    pseudo VARCHAR(255) NOT NULL,
    score INT,
    quiz_id INT,
    FOREIGN KEY (quiz_id) REFERENCES QUIZ(id)
);

CREATE TABLE QUIZ (
    id INT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description VARCHAR(255)
);

CREATE TABLE QUESTION (
    id INT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    score INT NOT NULL,
    quiz_id INT,
    FOREIGN KEY (quiz_id) REFERENCES QUIZ(id)
);

CREATE TABLE REPONSE (
    id INT PRIMARY KEY,
    reponse VARCHAR(255) NOT NULL,
    correct BOOLEAN NOT NULL,
    question_id INT,
    FOREIGN KEY (question_id) REFERENCES QUESTION(id)
);
