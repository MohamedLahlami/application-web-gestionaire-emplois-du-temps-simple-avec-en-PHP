<?php
include ("database.php");

class group{
    public $id;
    public $name;

    public function __construct($name){
        $this->name = $name;
    }

    public function insertGroup(Connection $connection, $name){
        $query = "INSERT INTO groups (name) VALUES ($name)";
        return mysqli_query($connection->conn, $query);
    }

    public function deleteGroupById(Connection $connection, $id){
        $query = "DELETE FROM groups WHERE id = $id";
        return mysqli_query($connection->conn, $query);
    }
}
?>