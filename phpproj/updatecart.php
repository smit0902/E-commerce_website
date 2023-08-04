<?php
include_once "config.php";
session_start();
include "invalidaccess.php";
if($_SERVER["REQUEST_METHOD"]=="GET")
{
  if(isset($_GET['act']) && $_GET['act']==="add" &&isset($_GET['pid']) && !empty($_GET['pid']))
  {
    $pid = trim($_GET['pid']) ;
    $uid =  $_SESSION['user_id'];

    $sql = "INSERT INTO cart(userid,prod_id) VALUES (:userid,:prodid)";
    $query=$con->prepare($sql);
    $query->bindParam(":userid",$uid);
    $query->bindParam(":prodid",$pid);

    if($query->execute())               //query execute status checking
    {
        header("location: cart.php");
        exit();
    }
    else
    {
        echo "Something went wrong!! Please try again later.!<br>";
    }
  }
}
if($_SERVER["REQUEST_METHOD"]=="GET")
{
  if(isset($_GET['act']) && $_GET['act']==="remove" &&isset($_GET['pid']) && !empty($_GET['pid']))
  {
    $pid = trim($_GET['pid']) ;
    $uid =  $_SESSION['user_id'];
  }
  $sql = "DELETE FROM cart WHERE prod_id = $pid";

  $query=$con->prepare($sql);
  if($query->execute())               //query execute status checking
    {
        header("location: cart.php");
    }
    else
    {
        echo "Something went wrong!! Please try again later.!<br>";
    }
  
}

?>