<?php   
include ("database.php");

class Sessions{
    public $id;
    public $teacher;
    public $day;
    public $time;
    public $room;
    public $group;
    public $subject;

    public function __construct($teacher, $day, $time, $room, $group, $subject){
    $this->teacher = $teacher;
    $this->day = $day;
    $this->time = $time;
    $this->room = $room;
    $this->group = $group;
    $this->subject = $subject;
    }

    public function insertSession(connection $con, $session){
        $insertSessionQuery = "INSERT INTO sessions(teacher, day, time, room, sessionGroup, subject) VALUES ('$session->tablename', '$session->day', '$session->time', '$session->room', '$session->sessionGroup', '$session->subject)";
        return mysqli_query($con->conn, $insertSessionQuery);
    }

    public function updateSession(connection $con, $teacher, $day, $time, $room, $sessionGroup, $subject){
        $insertSessionQuery = "INSERT INTO sessions(teacher, day, time, room, sessionGroup, subject) VALUES ('$teacher', '$day', '$time', '$room', '$sessionGroup', '$subject'";
        return mysqli_query($con->conn, $insertSessionQuery);
    }

    public static function getSessionsByGroup(connection $con, $group){
        $getSessionQuery = "
            SELECT 
                sessions.teacher, 
                sessions.day, 
                sessions.time, 
                sessions.room, 
                sessions.sessionGroup, 
                sessions.subject, 
                users.username AS 'teacherName', 
                rooms.name AS 'roomNumber', 
                groups.name AS 'groupNumber', 
                subjects.name AS 'subjectName'
            FROM 
                sessions
            JOIN 
                users ON sessions.teacher = users.id
            JOIN 
                rooms ON sessions.room = rooms.id
            JOIN 
                groups ON sessions.sessionGroup = groups.id
            JOIN 
                subjects ON sessions.subject = subjects.id
            WHERE
                sessionGroup = $group;
        ";
        $sessions = [];
        $result = mysqli_query($con->conn, $getSessionQuery);
        while ($row = mysqli_fetch_assoc($result)){
            $sessions[] = $row;
        }
        return $sessions;
    }

    public static function getSessionsByTeacher(connection $con, $teacher){
        $getSessionQuery = "
            SELECT 
                sessions.teacher, 
                sessions.day, 
                sessions.time, 
                sessions.room, 
                sessions.sessionGroup, 
                sessions.subject, 
                users.username AS 'teacherName', 
                rooms.name AS 'roomNumber', 
                groups.name AS 'groupNumber', 
                subjects.name AS 'subjectName'
            FROM 
                sessions
            JOIN 
                users ON sessions.teacher = users.id
            JOIN 
                rooms ON sessions.room = rooms.id
            JOIN 
                groups ON sessions.sessionGroup = groups.id
            JOIN 
                subjects ON sessions.subject = subjects.id
            WHERE
                teacher = $teacher;
        ";
        $sessions = [];
        $result = mysqli_query($con->conn, $getSessionQuery);
        while ($row = mysqli_fetch_assoc($result)){
            $sessions[] = $row;
        }
        return $sessions;
    }
}
?>