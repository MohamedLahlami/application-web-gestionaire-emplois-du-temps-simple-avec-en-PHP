<?php 
    session_start();

    include("database.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.php");
    }
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = $_GET['id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Change Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Project PHP</a></p>
        </div>

        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php
               if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];
                $group = $_POST['group'];

                if(!isset($id)){
                    //F I X   T H I S
                    $edit_query = mysqli_query($con->conn,"UPDATE users SET username='$username', email='$email', age='$age', studentGroup='$group'  WHERE Id = $_SESSION[id]") or die("error occurred");
                }else{
                    $edit_query = mysqli_query($con->conn,"UPDATE users SET username='$username', email='$email', age='$age', studentGroup='$group' WHERE Id=$id") or die("error occurred");
                }
                

                if($edit_query){
                    echo "<div class='message'>
                            <p>Profile Updated!</p>
                        </div> <br>";
                    echo "<a href='home.php'><button class='btn'>Go Home</button>";
       
                }
               }else{

                $query = mysqli_query($con->conn,"SELECT*FROM users WHERE Id=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['username'];
                    $res_Email = $result['email'];
                    $res_Age = $result['age'];
                    $res_Group = $result['studentGroup'];
                }

            ?>
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo $res_Age; ?>" autocomplete="off" required>
                </div>
                <!----------------EXPERIMENTAL---------------->
                <div class="field input">
                    <label for="group">Groupe</label>
                    <select name="group" id="group" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                    </select> 
                </div>
                <!----------------/EXPERIMENTAL---------------->
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>