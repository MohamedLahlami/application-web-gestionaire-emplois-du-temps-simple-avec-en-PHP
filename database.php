<?php
include ("classes/Connection.php");
$con = new connection();

$con->createdatabase("GestEmpTemps");

$createUsersQuery = "
CREATE TABLE IF NOT EXISTS users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    type VARCHAR(255) NOT NULL default 'student',
    studentGroup INT,
    FOREIGN KEY (studentGroup) REFERENCES groups (id)
);
";


$createSessionsQuery = "
CREATE TABLE IF NOT EXISTS sessions(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    teacher INT NOT NULL,
    day INT NOT NULL,
    time INT NOT NULL,
    room INT NOT NULL,
    sessionGroup INT NOT NULL,
    subject INT NOT NULL,
    FOREIGN KEY (subject) REFERENCES subjects (id),
    FOREIGN KEY (Teacher) REFERENCES users (id) ON DELETE CASCADE,
    FOREIGN KEY (sessionGroup) REFERENCES groups (id),
    FOREIGN KEY (Day) REFERENCES days (id),
    FOREIGN KEY (Time) REFERENCES time_intervals (id),
    FOREIGN KEY (Room) REFERENCES rooms (id)
);
";

$createsubjectsQuery = "
CREATE TABLE IF NOT EXISTS subjects(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);
";

$createGroupsQuery = "
CREATE TABLE IF NOT EXISTS groups(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);
";

$createRoomsQuery = "
CREATE TABLE IF NOT EXISTS rooms(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);
";

$createdaysquery = "
CREATE TABLE IF NOT EXISTS days(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);
";

$createIntervalsquery = "
 CREATE TABLE IF NOT EXISTS time_intervals(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);
";

$con->selectDatabase("GestEmpTemps");
$con->createTable($createGroupsQuery);
$con->createTable($createUsersQuery);
$con->createTable($createsubjectsQuery);
$con->createTable($createRoomsQuery);
$con->createTable($createdaysquery);
$con->createTable($createIntervalsquery);
$con->createTable($createSessionsQuery);
?>