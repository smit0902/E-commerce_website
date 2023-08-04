<?php
session_start();
include_once "config.php";

$username_err = $firstname_err = $lastname_err = $email_err = $password_err = "";
$password_matching_err = "";

$username = $firstname = $lastname = $email = $password = $confpassword = "" ;

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username = trim($_POST['username']);
	$firstname = trim($_POST['first_name']);
	$lastname = trim($_POST['last_name']);
	$email = trim($_POST['e-mail']);
	$password = trim($_POST['password']);
    $confpassword = trim($_POST['confpassword']);
	
	if($username=="") {
        $username_err = "User name can't be blank."	;
	}
    elseif(!filter_var($username, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z]+[a-zA-Z0-9_]*$/")))){
        $username_err = "Please enter a valid name.";
    }

    if($firstname=="") {
        $firstname_err = "First name can't be blank.";	
	}
    elseif(!filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z]+$/")))){
        $fistname_err = "Please enter a valid first name.";
    }
    

    if($lastname=="") {
        $lastname_err = "Last name can't be blank."	;
	}
    elseif(!filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z]+$/")))){
        $lasttname_err = "Please enter a valid last name.";
    }
    
    if($password=="") {
        $password_err= "Password can't be blank."	;
	}
    elseif(!filter_var($password, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z0-9_]+$/")))){
        $password_err = "Please enter a valid password .";
    }

    if($password!==$confpassword)
    {
        $password_matching_err = "Password not matching.";
    }
    
    
    if(empty($username_error) && empty($email_err) )
    {
        $sql = "SELECT * from users";
        $query=$con->prepare($sql);
        if($query->execute())
        {
            while($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                if($username==$row['username'])
                {
                    $username_err = "Username already exist.";
                    break;
                }
                if($email==$row['email'])
                {
                    $email_err = "Email already have one account.";
                    break;
                }
            } 
        }
        else
        {
            echo "Something went wrong!! Please try again later.!<br>";
            // header("location:register.php");
        }
    
    }
   	
	
	if(empty($username_err) && empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($password_err) && empty($password_matching_err) )
    {
        $password = sha1($password);
        $sql = "INSERT INTO users(username,firstname,lastname,email,password) VALUES(:username,:firstname,:lastname,:email,:password)";

        $query=$con->prepare($sql);
        
        $query->bindParam(":username",$username);
        $query->bindParam(":firstname",$firstname);
        $query->bindParam(":lastname",$lastname);
        $query->bindParam(":email",$email);
        $query->bindParam(":password",$password);
	

        if($query->execute())
        {
            header("location:login.php");
        }
        else
        {
            echo "Something went wrong!! Please try again later.!<br>";
            // header("location:register.php");
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
    <title>Register</title>
</head>
<body>
       <!-- CSS File -->
    <link rel="stylesheet" href='/phpproj/css/register_css.css' >

    <form action="" method="POST">
        <div class="card">
            <img src= '/phpproj/img/register_user.png' class="card-img-top user-image" alt="User Profile Image">
            <div class="card-body">
                <h5 class="card-title"><marquee behavior="alternate" >Register Your Self Here ! </marquee></h5>
                <p class="card-text">
                    <div class="row">
                        <div class="col-4">
                        <label for="username"><b>Username</b></label><br>
                        <input type="text" placeholder="Enter Username" name="username" value="<?php echo $username ;?>" required><br>
                        <p style="color: red;"><?php echo $username_err; ?></p><br>

                        <label for="first_name"><b>Firstname</b></label><br>
                        <input type="text" placeholder="Enter Firstname" name="first_name"  value="<?php echo $firstname ;?>"  required>
                        <p style="color: red;"><?php echo $firstname_err ;?></p><br>

                        <label for="last_name"><b>Lastname</b></label><br>
                        <input type="text" placeholder="Enter Lastname" name="last_name"  value="<?php echo $lastname ;?>" required><br>
                        <p style="color: red;"><?php echo $lastname_err ;?></p><br>
                        </div>

                        <div class="col-4">
                        <label for="email"><b>Email</b></label><br>
                        <input type="email" placeholder="Enter Email" name="e-mail"  value="<?php echo $email ;?>" required><br>
                        <p style="color: red;"><?php echo $email_err ;?></p><br>

                        <label for="password"><b>Password</b></label><br>
                        <input type="password" placeholder="Enter Password : minimum lenth 6 characters" name="password"  minlength="6" maxlength="12" required><br>
                        <p style="color: red;"><?php echo $password_err ;?></p><br>

                        <label for="confPassword"><b>Confirm Password</b></label><br>
                        <input type="password" placeholder="Re-Enter Password" name="confpassword" required>
                        <p style="color: red;"><?php echo $password_matching_err ;?></p><br>
                         
                        </div>
                    </div> 
                </p>
                <input class="btn btn-color col-12" type="submit" name="register" value="Register">
                <p class="footer">Already Have An Account ? <a href="login.php">Sign in</a> </p>
            </div>
        </div>
    </form>  
</body>
</html>
