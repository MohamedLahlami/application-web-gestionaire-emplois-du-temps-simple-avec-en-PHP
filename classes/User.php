<?php
include ("database.php");
class User{
    public $Id;
    public $username;
    public $email;
    public $password;
    public $age;
    public $type;
    public $group;

    public function __construct($username, $email, $password, $age, $type = 'student', $group = 'NULL'){
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->age = $age;
        $this->type = $type;
        $this->group = $group;
    }

    public function insertStudent(Connection $connection, $tablename){
        $sql = "INSERT INTO $tablename (Username, Email, Password, Age, type, studentGroup) VALUES ('$this->username', '$this->email', '$this->password', '$this->age', 'student', $this->group)";
        if(mysqli_query($connection->conn, $sql)){
         return true;
        }
    }

    public function insertTeacher(Connection $connection, $tablename){
        $sql = "INSERT INTO $tablename (Username, Email, Password, Age, type, studentGroup) VALUES ('$this->username', '$this->email', '$this->password', '$this->age', 'teacher')";
        if(mysqli_query($connection->conn, $sql)){
         return true;
        }
    }

    public function updateStudent(Connection $connection, $tablename, $id){
        $sql = "UPDATE $tablename SET Username = '$this->username', mail = '$this->email', age = '$this->age', studentGroup = '$this->group' WHERE Id = '$id'";
        mysqli_query($connection->conn, $sql) or die("Error Occured on update");
    }

    public function updateTeacher(Connection $connection, $tablename, $id){
        $sql = "UPDATE $tablename SET Username = '$this->username', mail = '$this->email', age = '$this->age' WHERE Id = '$id'";
        mysqli_query($connection->conn, $sql) or die("Error Occured on update");
    }

    public static function deleteUserById(Connection $connection, $tablename, $id){
        $sql = "DELETE FROM $tablename WHERE Id = '$id'";
        mysqli_query($connection->conn, $sql) or die("Error Occured on delete");
    }

    public static function getUserById(Connection $connection, $tablename, $id){
        $sql = "SELECT * FROM $tablename WHERE Id = '$id'";
        $result =mysqli_query($connection->conn, $sql) or die("Error Occured on select");
        $row = mysqli_fetch_assoc($result);
        return $row;	
    }

    public static function getAllStudents(Connection $connection, $tablename){
        $sql = "SELECT * FROM $tablename WHERE type = 'Student'";
        $result =mysqli_query($connection->conn, $sql) or die("Error Occured on select*");
        $students = [];
        while($row = mysqli_fetch_assoc($result)){
            $students[] = $row;
        }
        return $students;
    }

    public static function getAllTeachers(Connection $connection, $tablename){
        $sql = "SELECT * FROM $tablename WHERE type = 'prof'";
        $result =mysqli_query($connection->conn, $sql) or die("Error Occured on select*");
        $teachers = [];
        while($row = mysqli_fetch_assoc($result)){
            $teachers[] = $row;
        }
        return $teachers;
    }
}
?>