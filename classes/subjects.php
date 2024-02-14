<?php
include ("database.php");

class subject{
    public $id;
    public $name;

    public function __construct($name){
        $this->name = $name;
    }

    public function insertSubject(Connection $connection, $name){
        $query = "INSERT INTO subjects (name) VALUES ($name)";
        return mysqli_query($connection->conn, $query);
    }

    public function deleteSubjectById(Connection $connection, $id){
        $query = "DELETE FROM subjects WHERE id = $id";
        return mysqli_query($connection->conn, $query);
    }

    public function deleteSubjectByname(Connection $connection, $name){
        $query = "DELETE FROM subjects WHERE id = $name";
        return mysqli_query($connection->conn, $query);
    }
}
?>