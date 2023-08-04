<?php
session_start();
include "invalidaccess.php";

include_once "config.php";
$brandname_err = $brandnum_err = $image_err="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if (isset($_POST['add']) && isset($_FILES['brand_image']))
  {
    $brand_name = trim($_POST['brand_name']);
    $brand_num = trim($_POST['brand_num']);
    if($brand_name=="" )
	  {
		  $brandname_err = "Brand name can't be blank.";
	  }
    if($brand_num=="" )
	  {
		  $brandnum_err = "Brand number can't be blank.";
	  }

    if(empty($brandname_err) && empty($brandnum_err)){
      $sql = "SELECT * FROM brands WHERE brandnum=:brandnum";
      $query = $con->prepare($sql);
      $query->bindParam(":brandnum",$brand_num);
      if($query->execute())
      {
        $count = $query->rowCount();
        if($count!==0)
        {
          $brandnum_err = "Provided brandnum already exist.";
        }
      }

      else{
        echo "Something went wrong!! Please try again later.!<br>";
      }
    }

    $img_name = $_FILES['brand_image']['name'];
	  $img_size = $_FILES['brand_image']['size'];
	  $tmp_name = $_FILES['brand_image']['tmp_name'];
    $error = $_FILES['brand_image']['error'];

    if ($error === 0 && empty($brandname_err) && empty($brandnum_err)) 
    {
      if ($img_size > 1250000) 
      {
          $image_err = "Sorry, your file is too large.";
          
      }
      else 
      {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png","webp" ,"jfif"); 

        if (in_array($img_ex_lc, $allowed_exs)) 
        {
          $new_img_name = $brand_num.'.'.$img_ex_lc;
          $img_upload_path = 'img/brandimgs/'.$new_img_name;
          move_uploaded_file($tmp_name, $img_upload_path);
        }
        else 
			  {
				  $image_err = "You can't upload files of this type.";      
			  }
      }
    }
    if (empty($image_err) && empty($brandname_err) && empty($brandnum_err))
    {
      $imagename = $new_img_name;
      $sql = "INSERT INTO brands(brandnum,brandname,imagename) VALUES (:brandnum,:brandname,:imagename)";
      $query = $con->prepare($sql);
      $query->bindParam(":brandnum",$brand_num);
      $query->bindParam(":brandname",$brand_name);
      $query->bindParam(":imagename",$imagename);

      if($query->execute())
      {
        header("location:update.php");
      }
      else{
        echo "Something went wrong!! Please try again later.!<br>";
      }
    }
  }
  
}
  
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Brand</title>

    <!-- Logo Icon-->
    <link rel="icon" href="img/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/addbrand.css" />

    <!-- Bootstrap  -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;900&family=Ubuntu&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Navigation Bar -->
    <section>
      <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="update.php">
          <img class="logo" src="img/logo.png" alt="Logo Image" />
          Watch Bazaar
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarToggler"
          aria-controls="navbarToggler"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <div class="nav-link">Welcome, Admin!</div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </nav>
    </section>

    <!-- Add Brand -->
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
            <marquee behavior="alternate">Add Brand Here !</marquee>
          </h5>
          <p class="card-text">
            <label for="brand_name"><b>Brand Name : </b></label><br />
            <input class="text" type="text" name="brand_name" placeholder="Enter Brand Name" required /><br/>
            <?php echo $brandname_err;?><br>

            <label for="brand_num"><b>Brand Number (must be unique.) </b></label><br />
            <input class="text" type="text" name="brand_num" placeholder="Enter Brand Number" required /><br />
            <?php echo $brandnum_err;?><br>

            <label for=""><b>Title Image : </b></label><br/>
            <input type="file" name="brand_image" required /><br />
            <?php echo $image_err;?><br>
          </p>
          <input class="btn btn-dark col-12" type="submit" name="add" value="submit" />
        </div>
      </div>
    </form>

    <!-- Bootstrap Js-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
      crossorigin="anonymous"
    ></script>

    <!-- Font Awesome -->
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"
    ></script>
  </body>
</html>
