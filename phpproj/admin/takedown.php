<?php
session_start();
include "invalidaccess.php";

include_once "config.php";
if(isset($_GET['action']) && $_GET['action']==="removeprod" && isset($_GET['pid']))
{
    $prod_id = trim($_GET['pid']);
    $sql = "DELETE FROM products WHERE id = $prod_id";
    $query = $con->prepare($sql);
    if($query->execute()){
        header("location: productdetails.php");
    }
    else
    {
        echo "Something went wrong!! Please try again later.!<br>";
    }
}
if(isset($_GET['action']) && $_GET['action']==="removebrand" && isset($_GET['bid']))
{
    $brand_id = trim($_GET['bid']);
    $sql = "DELETE FROM brands WHERE id = $brand_id";
    $query = $con->prepare($sql);
    if($query->execute())
    {
        header("location:update.php");
    }
    else
    {
        echo "Something went wrong!! Please try again later.!<br>";
    }
}
if(isset($_GET['action']) && $_GET['action']==="downbrand" && isset($_GET['bid']))
{
    $brand_id = trim($_GET['bid']);
    $sql = "UPDATE brands SET status = 0 WHERE id = $brand_id";
    $query = $con->prepare($sql);
    if($query->execute())
    {
        header("location:update.php");
    }
    else
    {
        echo "Something went wrong!! Please try again later.!<br>";
    }
}
if(isset($_GET['action']) && $_GET['action']==="upbrand" && isset($_GET['bid']))
{
    $brand_id = trim($_GET['bid']);
    $sql = "UPDATE brands SET status = 1 WHERE id = $brand_id";
    $query = $con->prepare($sql);
    if($query->execute())
    {
        header("location:update.php");
    }
    else
    {
        echo "Something went wrong!! Please try again later.!<br>";
    }
}
if(isset($_GET['action']) && $_GET['action']==="downprod" && isset($_GET['pid']))
{
    $prod_id = trim($_GET['pid']);
    $sql = "UPDATE products SET status = 0 WHERE id = $prod_id";
    $query = $con->prepare($sql);
    if($query->execute()){
        header("location: productdetails.php");
    }
    else{
        echo "Something went wrong!! Please try again later.!<br>";
      }
}
if(isset($_GET['action']) && $_GET['action']==="upprod" && isset($_GET['pid']))
{
    $prod_id = trim($_GET['pid']);
    $sql = "UPDATE products SET status = 1 WHERE id = $prod_id";
    $query = $con->prepare($sql);
    if($query->execute()){
        header("location: productdetails.php");
    }
    else{
        echo "Something went wrong!! Please try again later.!<br>";
      }
}



?>