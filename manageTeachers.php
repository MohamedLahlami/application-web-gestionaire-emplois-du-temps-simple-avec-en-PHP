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
    <title>Manage users</title>
    <script src="script.js"></script>
</head>
<body>
      <div class="container">
        <div class="box form-box" style="width: auto;">
            <header>Manage teacher</header>
            <div class="bottom">
                <div class="box">
                    <p><span style="color: red">WARNING:</span> DELETING TEACHERS CAUSES THEIR SESSIONS TO BE DELETED TOO</p> 
                </div>
            </div>
            <table class="content-table">
                <thead>
                    <tr>
                        <th scope="col" >#Id</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Age</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $teachers = User::getAllTeachers($con, "users");
                        foreach ($teachers as $teacher){
                            echo "<tr>";
                            echo "<th scope='row'>".$teacher["id"]."</th>";
                            echo "<td>".$teacher["username"]."</td>";
                            echo "<td>".$teacher["email"]."</td>";
                            echo "<td>".$teacher["age"]."</td>";
                            echo "<td class='action-cell'>  
                                    <a class='btn edit-btn' href='editTeacher.php?id=$teacher[id]'>edit</a>
                                    <a class='btn delete-btn' href='delete.php?id=$teacher[id]'>delete</a>
                                  </td>";
                        }
                    ?>
                </tbody>
                </table>
        </div>
      </div>
</body>
</html>