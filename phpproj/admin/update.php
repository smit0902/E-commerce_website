<?php
session_start();
include "invalidaccess.php";

include_once "config.php";
$sql = "SELECT * FROM brands ";
$query=$con->prepare($sql);
if($query->execute())
{
    $result = $query->fetchAll();
}
else
{
    echo "Something went wrong!! Please try again later.!<br>";
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>

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
        <a class="navbar-brand" href="">
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
            <th class="title" scope="col">Available Brands</th>
            <th class="title" scope="col">Link</th>
          </tr>
        </thead>
        <tbody>
        <?php
            $num = 0;
            foreach($result as $row){
              $brandname = $row['brandname'];
              $bid = $row['id'];
              $status = $row['status'];
              $num++; 
        ?>
          <tr>
            <th scope="row"><?php echo $num;?></th>
            <td> <?php echo $brandname ;?></td>
            <td><a class="btn btn-outline-dark btn-sm" role="button" href="<?php echo "productdetails.php?id=".$bid;?>">Go to Products</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a class="btn btn-outline-danger btn-sm" role="button" href="takedown.php?action=removebrand&bid=<?php echo $bid ;?>">Remove Brands</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php if($status==1) {?>
            <a class="btn btn-outline-secondary btn-sm" role="button" href="takedown.php?action=downbrand&bid=<?php echo $bid ;?>">Out of Stock</a></td>
            <?php } else {?>
              <a class="btn btn-outline-primary btn-sm" role="button" href="takedown.php?action=upbrand&bid=<?php echo $bid ;?>">In Stock</a></td>
            <?php }?>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>

    

    <center>
    <a class="btn custom btn-dark" role="button" href="addbrand.php">Add Brand</a>
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
