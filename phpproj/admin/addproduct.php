<?php
session_start();
include "invalidaccess.php";

if($_SERVER["REQUEST_METHOD"]=="GET")
{
  if(isset($_GET['bid'])&&!empty($_GET['bid']))
  {
    $_SESSION['brand_id'] = $_GET['bid'];   
  }
}
include_once "config.php";
$modelnum_err = $price_err = $image_err="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if (isset($_POST['addprod']) && isset($_FILES['prod_image']))
  {
    $brand_id = $_SESSION['brand_id'];
    $model_num= trim($_POST['model_num']);
    $price = trim($_POST['price']);

    if($model_num=="" )
	  {
		  $modelnum_err = "Brand name can't be blank.";
	  }
    if($price=="" )
	  {
		  $price_err = "Brand number can't be blank.";
	  }

    if(empty($modelnum_err) && empty($price_err))
    {
      $sql = "SELECT * FROM products WHERE model_no=:model_no";
      $query = $con->prepare($sql);
      $query->bindParam(":model_no",$model_num);
      if($query->execute())
      {
        $count = $query->rowCount();
        if($count!==0)
        {
          $modelnum_err = "Provided model number already exist.";
        }
      }

      else{
        echo "Something went wrong!! Please try again later.!<br>";
      }
    }

    $img_name = $_FILES['prod_image']['name'];
	  $img_size = $_FILES['prod_image']['size'];
	  $tmp_name = $_FILES['prod_image']['tmp_name'];
    $error = $_FILES['prod_image']['error'];

    if ($error === 0 && empty($modelnum_err) && empty($price_err)) 
    {
      if ($img_size > 1250000) 
      {
          $image_err = "Sorry, your file is too large.";
      }
      else 
      {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);

        $allowed_exs = array("jpg", "jpeg", "png","webp","jfif"); 

        if (in_array($img_ex_lc, $allowed_exs)) 
        {
          $new_img_name = $model_num.'.'.$img_ex_lc;
          $img_upload_path = 'img/productimgs/'.$new_img_name;
          move_uploaded_file($tmp_name, $img_upload_path);
        }
        else 
			  {
				  $image_err = "You can't upload files of this type.";      
			  }
      }
    }
    if (empty($image_err) && empty($modelnum_err) && empty($price_err))
    {
      $imagename = $new_img_name;
      $sql = "INSERT INTO products (brand_id,model_no,price,image_name) VALUES(:brand_id,:model_no,:price,:imagename)";
      $query = $con->prepare($sql);
      $query->bindParam(":brand_id",$brand_id);
      $query->bindParam(":model_no",$model_num);
      $query->bindParam(":price",$price);
      $query->bindParam(":imagename",$imagename);

      if($query->execute())
      {
        header("location:productdetails.php");
        // echo "done";
      }
      else{
        echo "Something went wrong!! Please try again later.!<br>";
        // header("location:addbrand.php");
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
    <title>Add Product</title>

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
            <marquee behavior="alternate">Add Product Here !</marquee>
          </h5>
          <p class="card-text">
            <label for=""><b>Model No : </b></label><br />
            <input class="text" type="text" name="model_num" placeholder="Enter Model Number (must be unique)." required /><br/>
            <?php echo $modelnum_err;?><br>
            <label for=""><b>Price : </b></label><br />
            <input class="text" type="text" name="price" placeholder="Enter Price" required /><br />
            <?php echo $price_err;?><br>

            <label for=""><b>Title Image : </b></label><br />
            <input type="file" name="prod_image" required /><br/>
            <?php echo $image_err;?><br>
          </p>
          <input class="btn btn-dark col-12" type="submit" name="addprod" value="Submit" />
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
