<?php
  include_once "config.php";
  session_start();
  include "invalidaccess.php";

  $uid = $_SESSION['user_id'];

  $sql = "SELECT * FROM products WHERE id IN (SELECT prod_id FROM cart WHERE userid = $uid)"; // fetching products with userid with help of cart table.

  $query=$con->prepare($sql);
  if($query->execute())
  {
    $result = $query->fetchAll();
  }
  else
  { 
    echo "Something went wrong!! Please try again later.!<br>";
    // header("location: index.php");
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart</title>

    <!-- Logo Icon-->
    <link rel="icon" href="img/logo.png" type="image/x-icon" />

    <!-- CSS file -->
    <link rel="stylesheet" href="css/cart.css" />

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
    
    <section id="navigation_bar">
        <nav class="navbar navbar-expand-lg navbar-custom">
          <a class="navbar-brand" href="">
          <img class="logo" src="img/logo.png" alt="Logo Image">
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
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  >Categories</a
                >
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li>
                    <a class="dropdown-item" href="Jaeger-LeCoultre.html">Jaeger-LeCoultre</a
                    >
                  </li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="Audemars Piguet.html"
                      >Audemars Piguet</a
                    >
                  </li>
                  <li><hr class="dropdown-divider" /></li>
                  <li><a class="dropdown-item" href="Rolex.html">Rolex</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="Omega.html">Omega</a>
                  </li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="Tudor.html">Tudor
                    </a>
                  </li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="Breitling.html">Breitling</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#footer">Contact us</a>
                <?php
                if(isset($_SESSION['username']))
                {
              ?>
                  <li class="nav-item">
                    <a class="nav-link" href="login_register/logout.php">Logout</a>
                  </li>

               <?php } else {?> 

                  <li class="nav-item">
                    <a class="nav-link" href="login_register/login.php">Login</a>
                  </li>

              <?php  } ?>
              <?php
                if(isset($_SESSION['username']))
                {
              ?>
              <li class="nav-item">
              <a href="cart.php"><i class="fas fa-2x fa-shopping-cart"></i></a>
              </li>
              <?php  } ?>
            </ul>
          </div>
        </nav>
      </section>

    <!-- Cart Table -->
    <section id="brand">
      <table class="table table-light table-hover table-bordered border-dark">
        <thead>
          <tr>
            <th class="title" scope="col">No.</th>
            <th class="title" scope="col">Image</th>
            <th class="title" scope="col">Model No.</th>
            <th class="title" scope="col">Price</th>
            <th class="title" scope="col">Link</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $cnt=0;
            foreach($result as $row)
            {
              $pid = $row['id'];
              $model_no = $row['model_no'];
              $price = $row['price'];
              $imagename = $row['image_name'];
              $cnt++;
          ?>

          <tr>
            <th scope="row"><?php echo $cnt;?></th>
            <td><img class="cart-img" src="/phpproj/admin/img/productimgs/<?php echo $imagename ;?>" alt="cart image" /></td>
            <td><?php echo $model_no;?> </td>
            <td><?php echo $price;?>&#8377; </td>
            <td>
              <a class="btn btn-dark btn-sm" role="button" href="updatecart.php?act=remove&pid=<?php echo $pid;?>">Remove</a>
            </td>
          </tr>

          <?php }?>

        </tbody>
      </table>
    </section>

    <center>
      <a class="btn custom btn-dark" role="button" href="checkout.php"
        >Check Out</a
      >
    </center>

          <!-- Footer -->
    <section id="footer">
      
        <i class="fab fa-facebook-f social"></i>
        <i class="social fab fa-twitter"></i>
        <i class="social fab fa-instagram"></i>
        <i class="social fas fa-envelope"></i>
        
  
      </section>

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
