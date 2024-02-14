<?php 
   session_start();
   include("classes/Sessions.php");
   if(!isset($_SESSION['valid'])){
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
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Timetable portal</a> </p>
        </div>

        <div class="right-links">

            <?php 
            
            $id = $_SESSION['id'];
            $query = mysqli_query($con->conn,"SELECT*FROM users WHERE Id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['username'];
                $res_Email = $result['email'];
                $res_Age = $result['age'];
                $res_id = $result['id'];
                $res_type = $result['type'];
                $res_group = $result['studentGroup'];
            }
            
            if ($res_type == 'admin'){
                echo "<a href='manageStudents.php'><button class='btn'>Manage students</button></a>";
                echo "<a href='manageTeachers.php'><button class='btn'>Manage teachers</button></a>";    
            }

            if ($res_type == 'student'){
                echo "<a href='editStudent.php?id=$res_id'><button class='btn'>Edit profile</button></a>";
            }else{
                echo "<a href='editTeacher.php?id=$res_id'><button class='btn'>Edit profile</button></a>";
            }
            
            ?>

            <a href='logout.php'> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <main>
       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
            </div>
            <div class="box">
                <p>Your email is <b><?php echo $res_Email ?></b>.</p>
            </div>
            <div class="box">
                <p>You are a <b><?php echo $res_type ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>And you are <b><?php echo $res_Age ?> years old</b>.</p> 
            </div>
          </div>
          <?php 
            function displayTable(){
                echo '
                    <div>
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>8:30 - 10:00</th>
                                    <th>10:15 - 11: 45</th>
                                    <th>14:30 - 16:00</th>
                                    <th>16:15 - 17:45</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Lundi</td>
                                    <td><div id="11"></div></td>
                                    <td><div id="12"></div></td>
                                    <td><div id="13"></div></td>
                                    <td><div id="14"></div></td>
                                </tr>
                                <tr>
                                    <td>Mardi</td>
                                    <td><div id="21"></div></td>
                                    <td><div id="22"></div></td>
                                    <td><div id="23"></div></td>
                                    <td><div id="24"></div></td>
                                </tr>
                                <tr>
                                    <td>Mercredi</td>
                                    <td><div id="31"></div></td>
                                    <td><div id="32"></div></td>
                                    <td><div id="33"></div></td>
                                    <td><div id="34"></div></td>
                                </tr>
                                <tr>
                                    <td>Jeudi</td>
                                    <td><div id="41"></div></td>
                                    <td><div id="42"></div></td>
                                    <td><div id="43"></div></td>
                                    <td><div id="44"></div></td>
                                </tr>
                                <tr>
                                    <td>Vendredi</td>
                                    <td><div id="51"></div></td>
                                    <td><div id="52"></div></td>
                                    <td><div id="53"></div></td>
                                    <td><div id="54"></div></td>
                                </tr>
                                <tr>
                                    <td>Samedi</td>
                                    <td><div id="61"></div></td>
                                    <td><div id="62"></div></td>
                                    <td><div id="63"></div></td>
                                    <td><div id="64"></div></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>';
            }
            if ($res_type != "admin") {
                if ($res_type == "student") {
                    $data = json_encode(Sessions::getSessionsByGroup($con, $res_group));
                }else{
                    $data = json_encode(Sessions::getSessionsByTeacher($con, $res_id));
                }
                displayTable();
                echo "<script type='text/javascript'>
                        function displaySession(session){
                            document.getElementById(session.day.toString() + session.time.toString()).innerHTML = (\"<p class='p-teacher'>Pr. \" + session.teacherName.toString() + \"</p>\" + \"<p class='p-subject'>\" + session.subjectName.toString() + \"</p><p class='p-room'>\" + session.roomNumber.toString() + \"</p>\");
                        }
                        var data = $data;
                        for (var i = 0; i < data.length; i++) {
                            displaySession(data[i]);
                        }
                        console.log(data);
                     </script>";
            }else{
                $nbrAdmins = array_values(mysqli_fetch_assoc(mysqli_query($con->conn, "SELECT count(*) FROM users WHERE type = 'admin'")))[0];
                $nbrStudents = array_values(mysqli_fetch_assoc(mysqli_query($con->conn, "SELECT count(*) FROM users WHERE type='student'")))[0];
                $nbrTeachers = array_values(mysqli_fetch_assoc(mysqli_query($con->conn, "SELECT count(*) FROM users WHERE type='prof'")))[0];
                $nbrSubjects = array_values(mysqli_fetch_assoc(mysqli_query($con->conn, "SELECT count(*) FROM subjects")))[0];
                $nbrRooms = array_values(mysqli_fetch_assoc(mysqli_query($con->conn, "SELECT count(*) FROM rooms")))[0];
                $nbrGroups = array_values(mysqli_fetch_assoc(mysqli_query($con->conn, "SELECT count(*) FROM groups")))[0];
                $nbrSessions = array_values(mysqli_fetch_assoc(mysqli_query($con->conn, "SELECT count(*) FROM sessions")))[0];
                echo '
                    <div class="bottom">
                        <div class="box">
                            <p>There are currently <b>'.$nbrAdmins.'</b> admins in the system (including you).</p> 
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="box">
                            <p>There are currently <b>'.$nbrStudents.'</b> students in the system.</p> 
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="box">
                            <p>There are currently <b>'.$nbrTeachers.'</b> teachers in the system.</p> 
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="box">
                            <p>There are currently <b>'.$nbrSessions.'</b> sessions in the system.</p> 
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="box">
                            <p>There are currently <b>'.$nbrSubjects.'</b> subjects in the system.</p> 
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="box">
                            <p>There are currently <b>'.$nbrGroups.'</b> groups in the system.</p> 
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="box">
                            <p>There are currently <b>'.$nbrRooms.'</b> rooms in the system.</p> 
                        </div>
                    </div>
                ';
            }
          ?>
       </div>

    </main>
</body>
</html>