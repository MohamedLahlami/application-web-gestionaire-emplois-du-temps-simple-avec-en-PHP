<?php
session_start();
include("classes/User.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $type = mysqli_query($con->conn, "SELECT type FROM users WHERE id = $id")->fetch_object()->type;
    User::deleteUserById($con, "users", $id);
    if ($type == "student") {
        header("Location: manageStudents.php");
    }else{
        header("Location: manageTeachers.php");

    }
}
?>