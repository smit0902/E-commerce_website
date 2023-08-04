<?php
include_once "config.php";
session_start();
$username_err = $password_err = $match_err="";
$username = "";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	
	if($username=="" )
	{
		$username_err = "User name can't be blank.";
	}
    elseif(!filter_var($username, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9]+$/")))){
        $username_err = "Please enter a valid name.";
    }

    if($password_err = ""){
        $password_err = "Password can't be blank.";
    }

    if(empty($username_err) && empty($password_err)){
        $password = sha1($password);
        $sql = "SELECT * FROM admins WHERE username=:username AND password=:password";
        $query = $con->prepare($sql);
        $query->bindParam(":username",$username);
        $query->bindParam(":password",$password);
        
        if($query->execute())
        {      
            $count = $query->rowCount();
            $row   = $query->fetch(PDO::FETCH_ASSOC);

            if($count == 1 && !empty($row)) 
            {
                $_SESSION['adminname'] = $username;
                if(isset($_SESSION['error']))
                {
                    unset($_SESSION['error']);
                }
                header("location:update.php");
                exit();
            }
            else
            {
                $match_err = "<center><h3><font color=red>The username or password is/are incorrect.</h3></center>";
            }
        }
        else
        {
            echo "Something went wrong!! Please try again later.!<br>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
</head>
<body>
    
    <!-- CSS File -->
    <link rel="stylesheet" href='/phpproj/css/login_css.css'>

   <p style="color: red; align: center"><?php if(isset($_SESSION['error'])){ echo $_SESSION['error'] ; }?></p>
    <form action="" method="POST">
        <div class="card">
            <img src= /phpproj/img/login_user.png class="card-img-top user-image" alt="User Profile Image">
            <div class="card-body">
                <h5 class="card-title"><marquee behavior="alternate" >Welcome to Login Page !</marquee></h5>
                <p class="card-text">
                    <label for="username"><b>Username</b></label><br>
                    <input type="text" placeholder="Enter Username" name="username" required><br>
                    <p style="color: red;"><?php echo $username_err; ?></p><br>

                    <label for="password"><b>Password</b></label><br>
                    <input type="password" placeholder="Enter Password" name="password" required><br>
                    <p style="color: red;"><?php echo $password_err ;?></p><br>
                </p>
                <input class="btn btn-color col-12" type="submit" value="login">
                <!-- <p class="footer">Don't Have An Account ? <a href="register.php">Sign up</a> </p> -->
            </div>
        </div>
    </form>
    <br>
    <?php echo $match_err;?>

    
</body>
</html>