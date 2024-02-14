<?php
include ("database.php");

$populateStaticUsers = "
INSERT INTO 
    users(username, email, password, age, type)
VALUES
    ('admin', 'admin', '$2a$12\$W30SzWHTfUc5nqZ7JFtyau7XVUtFygkSLwr1jmRI2mIC3HmgLVdeC', 23, 'admin'),
    ('amine', 'aminephp@gmail.com', '$2a$12\$R.Stz3VC2lCeTQPgt19.0eVDx87zxgHlZzYqW7nSAN6GiBxBIaO7e', 26, 'prof'),
    ('aaqil', 'aaqilréseaux@gmail.com', '$2a$12\$eJgUzctA.ohHgFhK3G6YZ.s0ksOF/HDHbK7aKlH71kp.3zfiRzW5a', 40, 'prof'),
    ('ahmed', 'ahmedcpp@gmail.com', '$2a$12\$YRUD097k0CjxSIaLN7.KJ.k7toYkxTgRuVHARCEm3EJteMMI7.st6', 50, 'prof'),
    ('anouar', 'anouarcompta@gmail.com', '$2a$12$1BLW8qRPITpLa18RZrMafOGEj8gMqGhNhiT14YrTU.ySySlqhKceS', 30, 'prof'),
    ('youssra', 'youssrasql@gmail.com', '$2a$12\$pALZTiiDCo55admdTGQkxeGRgSi0mpFvEGAvc1KGgE/spT6LfJlym', 26, 'prof'),
    ('maria', 'mariamerise@gmail.com', '$2a$12\$SfDqzEqMZsxcrmvrOklIdeJSIheRrPVkkU4ZAEiQlhUXe/bKl39Py', 32, 'prof'),
    ('mohamed', 'mohamedtp@gmail.com', '$2a$12\$cos3ucSnlIODTVCggUqSFeqsRFzzgmCsVDl0A0584xUL.hpI9shDe', 39, 'prof'),
    ('imane', 'imanelinux@gmail.com', '$2a$12$4rb8B2Y7xJ2egJixwC9QWOMe2JKlqHShXkQO0ikRfBKREpMkPseqe', 27, 'prof'),
    ('mounir', 'mounireng@gmail.com', '$2a$12\$ug5lBkbdfUFbhyfAZWEy6eTT2OO3oaT8I2JvIgOiOCY00fwY0s6tC', 43, 'prof'),
    ('anas', 'anasgestion@gmail.com', '$2a$12$0oNbmtQmDffPKao2hGxPWuTlm1TN8GobGd2v4p01mYH/gADOeZljO', 45, 'prof'),
    ('abdellah', 'abdellahtec@gmail.com', '$2a$12`\$c7Ke1jfjq5leinOH/zRbBOO/6p2s1TmRr0euxfCmYVY8uZ3gEy8eu', 52, 'prof');
";

$populateSessions = "
INSERT INTO 
    sessions(teacher, day, time, room, sessionGroup, subject)
VALUES
    (2, 1, 1, 10, 1, 3),
    (2, 1, 2, 10, 2, 3),
    (2, 2, 1, 10, 3, 3),
    (2, 2, 2, 10, 4, 3),
    (2, 4, 1, 10, 5, 3),
    (2, 4, 2, 10, 6, 3),
    (2, 6, 1, 10, 7, 3),

    (4, 1, 3, 1, 1, 4),
    (4, 1, 4, 1, 2, 4),
    (4, 2, 3, 1, 3, 4),
    (4, 2, 4, 1, 4, 4),
    (4, 4, 3, 1, 5, 4),
    (4, 4, 4, 1, 6, 4),
    (4, 6, 2, 1, 7, 4),

    (5, 1, 2, 2, 1, 7),
    (5, 1, 1, 2, 2, 7),
    (5, 2, 2, 2, 3, 7),
    (5, 2, 1, 2, 4, 7),
    (5, 4, 2, 2, 5, 7),
    (5, 4, 1, 2, 6, 7),
    (5, 6, 3, 2, 7, 7),

    (6, 1, 4, 3, 1, 6),
    (6, 1, 3, 3, 2, 6),
    (6, 2, 4, 3, 3, 6),
    (6, 2, 3, 3, 4, 6),
    (6, 4, 4, 3, 5, 6),
    (6, 4, 3, 3, 6, 6),
    (6, 6, 4, 3, 7, 6),

    (7, 3, 1, 4, 1, 10),
    (7, 3, 2, 4, 2, 10),
    (7, 5, 1, 4, 3, 10),
    (7, 5, 2, 4, 4, 10),
    (7, 6, 1, 4, 5, 10),
    (7, 6, 2, 4, 6, 10),
    (7, 1, 1, 4, 7, 10),

    (8, 3, 2, 5, 1, 9),
    (8, 3, 1, 5, 2, 9),
    (8, 5, 2, 5, 3, 9),
    (8, 5, 1, 5, 4, 9),
    (8, 6, 2, 5, 5, 9),
    (8, 6, 1, 5, 6, 9),
    (8, 1, 2, 5, 7, 9),

    (9, 4, 1, 6, 1, 11),
    (9, 4, 2, 6, 2, 11),
    (9, 5, 3, 6, 3, 11),
    (9, 5, 4, 6, 4, 11),
    (9, 1, 1, 6, 5, 11),
    (9, 1, 2, 6, 6, 11),
    (9, 1, 3, 6, 7, 11),

    (10, 4, 2, 7, 1, 2),
    (10, 4, 1, 7, 2, 2),
    (10, 5, 4, 7, 3, 2),
    (10, 5, 3, 7, 4, 2),
    (10, 1, 2, 7, 5, 2),
    (10, 1, 1, 7, 6, 2),
    (10, 4, 2, 7, 7, 2),

    (11, 5, 3, 8, 1, 8),
    (11, 5, 4, 8, 2, 8),
    (11, 4, 1, 8, 3, 8),
    (11, 4, 2, 8, 4, 8),
    (11, 3, 1, 8, 5, 8),
    (11, 3, 2, 8, 6, 8),
    (11, 3, 3, 8, 7, 8),

    (12, 5, 4, 9, 1, 1),
    (12, 5, 3, 9, 2, 1),
    (12, 4, 2, 9, 3, 1),
    (12, 4, 1, 9, 4, 1),
    (12, 3, 2, 9, 5, 1),
    (12, 3, 3, 9, 6, 1),
    (12, 3, 1, 9, 7, 1),

    (3, 2, 1, 11, 1, 5),
    (3, 2, 2, 11, 2, 5),
    (3, 1, 1, 11, 3, 5),
    (3, 1, 2, 11, 4, 5),
    (3, 5, 1, 11, 5, 5),
    (3, 5, 2, 11, 6, 5),
    (3, 1, 4, 11, 7, 5)
";

$popolateGroups = "
INSERT INTO groups VALUES (1, 'groupe1'), (2, 'groupe2'), (3, 'groupe3'), (4, 'groupe4'), (5, 'groupe5'), (6, 'groupe6'), (7, 'groupe7');
";

$popolateRooms = "
INSERT INTO rooms VALUES (1, 'A1'), (2, 'A2'), (3, 'A3'), (4, 'B1'), (5, 'B2'), (6, 'B3'), (7, 'C1'), (8, 'C2'), (9, 'C3'), (10, 'CC4'), (11, 'CC3');
";

$populateDays = "
INSERT INTO days VALUES (1, 'lundi'), (2, 'mardi'), (3, 'mercredi'), (4, 'jeudi'), (5, 'vendredi'), (6, 'samedi');
";

$populateSubjects = "
INSERT INTO subjects VALUES (1, 'TEC'), (2, 'ENGLAIS'), (3, 'PHP'), (4, 'C++'), (5, 'RESEAUX'), (6, 'BASES DES DONNEES'), (7, 'COMPTABILITE ANALYTIQUE'), (8, 'GESTION DES ENTREPRISE'), (9, 'TP C++'), (10, 'MERISE 2'), (11, 'LINUX');
";

$populateIntervales = "
INSERT INTO time_intervals VALUES (1, 'matinSeance1'), (2, 'matinSeance2'), (3, 'aprèsmidiSéance1'), (4, 'aprèsmidiSéance2');
";

$con->conn->query($populateStaticUsers);
$con->conn->query($popolateGroups);
$con->conn->query($popolateRooms);
$con->conn->query($populateDays);
$con->conn->query($populateSubjects);
$con->conn->query($populateIntervales);
$con->conn->query($populateSessions);

echo "<h1>The database is initialized successfully.</h1>";
?>