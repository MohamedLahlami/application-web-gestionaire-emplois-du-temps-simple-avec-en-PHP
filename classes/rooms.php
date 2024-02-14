<?php
include ("database.php");

class room{
    public $id;
    public $name;

    public function __construct($name){
        $this->name = $name;
    }

    public function insertRoom(Connection $connection, $name){
        $query = "INSERT INTO rooms (name) VALUES ($name)";
        return mysqli_query($connection->conn, $query);
    }

    public function deleteRoomById(Connection $connection, $id){
        $query = "DELETE FROM rooms WHERE id = $id";
        return mysqli_query($connection->conn, $query);
    }

    public function deleteRoomByname(Connection $connection, $name){
        $query = "DELETE FROM rooms WHERE id = $name";
        return mysqli_query($connection->conn, $query);
    }
}
?>