<?php 
   session_start();
   include ("classes/User.php");
   if(!(isset($_SESSION['valid']) && $_SESSION['type'] == 'admin')){
    header("Location: index.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Manage students</title>
    <script src="script.js"></script>
</head>
<body>
      <div class="container">
        <div class="box form-box" style="width: auto;">
            <header>Manage Students</header>
            <table class="content-table">
                <thead>
                    <tr>
                        <th scope="col" >#Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Age</th>
                        <th scope="col">group</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $students = User::getAllStudents($con, "users");
                        foreach ($students as $student){
                            echo "<tr>";
                            echo "<th scope='row'>".$student["id"]."</th>";
                            echo "<td>".$student["username"]."</td>";
                            echo "<td>".$student["email"]."</td>";
                            echo "<td>".$student["age"]."</td>";
                            echo "<td>".$student["studentGroup"]."</td>";
                            echo "<td class='action-cell'>
                                    <a class='btn edit-btn' href='editStudent.php?id=$student[id]'>edit</a>
                                    <a class='btn delete-btn' href='delete.php?id=$student[id]'>delete</a>
                                  </td>";
                        }
                    ?>
                </tbody>
                </table>
        </div>
      </div>
</body>
</html>