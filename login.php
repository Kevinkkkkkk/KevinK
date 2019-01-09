<?php

// make db conection
require('db.php');

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) ||
    empty($_POST['password'])) {
        $error = "Username or Password is empty";
    }else{
        // Save username & password in a variable
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        //2. Prepare query
        $query = "SELECT username, password, level ";
        $query .="FROM users ";
        $query .="WHERE username = '$username' AND password = '$password'";
        
        //2. Execute query
        $result = mysqli_query($connection, $query);
        
        if (!$result) {
            die("query is wrong");
        }
        //Save data to $row
        $row = mysqli_fetch_array($result);
        //Check how many answer did we get 
        $numrows=mysqli_num_rows($result);
            if ($numrows == 1) {
                //Start to use sessions
                session_start();
                
                //Create session variable
                $_SESSION['login_user'] = $username;
                $_SESSION['login_level'] = $row['level'];

            header('Location: homepage.php');
            }else {
                $error = "Login failed";
            }
        
        //4. free results
            mysqli_free_result($result);
        
    }
}


//5. close db connection
mysqli_close($connection);
?>

<html>
<head>
    <title>Panda Park Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        <style type="text/css">
         body {background-image:url(picture/bg.jpg);}
</style>
    <header> Welcome to Chengdu Panda Park Information System</header>
       
        
    </body>
</html>



   

<div class="input">
    <form action="login.php" method="post">
         <?php   
    if (isset($error)) {
        echo "<span>" . $error . "</span>";
    }
    ?>
         
        
       <br>&nbsp;<input type="text" name="username" placeholder="Username"> <br/>
        
        <input type="password" name="password" placeholder="Password"><br/>
        <br>
        <input type="submit" name="submit" value="Login">
       
            </form>
</div>