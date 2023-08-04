<?php
session_start();
include "invalidaccess.php";

include_once "config.php";
if(isset($_GET['id']) && !empty($_GET['id']))
{
  $brand_id = $_GET['id'];
  $_SESSION['brand_id'] = $_GET['id']; 
}
elseif(isset($_SESSION['brand_id']) && !empty($_SESSION['brand_id']))
{
  $brand_id = $_SESSION['brand_id'];
}

if(isset($brand_id) && !empty($brand_id))
{
  $sql = "SELECT * FROM products WHERE brand_id = :brand_id";
  $query=$con->prepare($sql);
  $query->bindParam("brand_id",$brand_id);
  if($query->execute())
  {
    $result_products = $query->fetchAll();
  }
  else
  {
    echo "Something went wrong!! Please try again later.!<br>";
    header("location: index.php");
  } 
}   
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Details</title>

    <!-- Logo Icon-->
    <link rel="icon" href="img/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/index.css" />

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

    <!-- Brand Table -->
    <section id="brand">
      <table class="table table-light table-hover table-bordered border-dark">
        <thead>
          <tr>
            <th class="title" scope="col">No.</th>
            <th class="title" scope="col">Model No.</th>
            <th class="title" scope="col">Price</th>
            <th class="title" scope="col">Link</th>
          </tr>
        </thead>
        <tbody>
        <?php
            $count =0;
            foreach($result_products as $row)
            {
              $model_no = $row['model_no'];
              $price = $row['price']; 
              $pid = $row['id'];  
              $status = $row['status'];         
              $count++;
        ?>
          <tr>
            <th scope="row"><?php echo $count ; ?></th>
            <td><?php echo $model_no ; ?></td>
            <td><?php echo $price ; ?> &#8377;</td>
            <td><a class="btn btn-outline-danger btn-sm" role="button"  href="takedown.php?action=removeprod&pid=<?php echo $pid?>">Remove</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php if($status==1) {?>
            <a class="btn btn-outline-secondary btn-sm" role="button" href="takedown.php?action=downprod&pid=<?php echo $pid ;?>">Out of Stock</a></td>
            <?php } else {?>
              <a class="btn btn-outline-primary btn-sm" role="button" href="takedown.php?action=upprod&pid=<?php echo $pid ;?>">In Stock</a></td>
            <?php }?>
          </td>
          </tr>

          <?php } ?>
          <!-- <tr>
            <th scope="row">2</th>
            <td>JL0002</td>
            <td>5000 &#8377;</td>
            <td><a class="btn btn-dark btn-sm" role="button" href="">Remove</a></td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>JL0003</td>
            <td>5000 &#8377;</td>
            <td><a class="btn btn-dark btn-sm" role="button" href="">Remove</a></td>
          </tr>
          <tr>
            <th scope="row">4</th>
            <td>JL0004</td>
            <td>5000 &#8377;</td>
            <td><a class="btn btn-dark btn-sm" role="button" href="">Remove</a></td>
          </tr>
          <tr>
            <th scope="row">5</th>
            <td>JL0005</td>
            <td>5000 &#8377;</td>
            <td><a class="btn btn-dark btn-sm" role="button" href="">Remove</a></td>
          </tr>
          <tr>
            <th scope="row">6</th>
            <td>JL0006</td>
            <td>5000 &#8377;</td>
            <td><a class="btn btn-dark btn-sm" role="button" href="">Remove</a></td>
          </tr> -->
        </tbody>
      </table>
    </section>

    <center>
    <a class="btn custom btn-dark" role="button" href="<?php echo "addproduct.php?bid=".$brand_id?>">Add Product</a>
    </center>

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
