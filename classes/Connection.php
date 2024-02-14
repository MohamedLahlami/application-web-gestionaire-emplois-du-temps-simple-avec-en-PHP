<?php
class Connection{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    public $conn;

    public function __construct(){
        $this->conn = new mysqli ($this->hostname, $this->username, $this->password);
    }

    function createdatabase($dbname){
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $this->conn->query($sql);
    }

    function selectDatabase($dbname){
        $this->conn->select_db($dbname);
    }
    
    function createTable($query){
        $this->conn->query($query);
    }
}
?>