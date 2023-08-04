<?php 
include_once "config.php";
session_start();
$sql = "SELECT * FROM brands WHERE status = 1 ";
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Bazaar</title>

    <!-- Logo Icon-->
    <link rel="icon" href="img/logo.png" type="image/x-icon">

    <!-- Bootstrap  -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />

    <!-- CSS Files -->
    <link rel="stylesheet" href="css/home.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;900&family=Ubuntu&display=swap" rel="stylesheet">

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
                <a class="nav-link" href="">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  >Categories</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php
                      foreach($result as $row){
                        $brandname = $row['brandname'];
                        $bid = $row['id'];
                  ?>
                  <li>
                    <a class="dropdown-item" href="<?php echo "products.php?id=".$bid;?>"> <?php echo $brandname ;?></a>
                  </li>
                  <li><hr class="dropdown-divider"/></li>
                  <?php }?>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#footer">Contact us</a>
              </li>
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

      <!--Front -->
        <section id="front">
        <div class="row space">
            <div class="col-lg-6">
                <h1 class="des-title">All Brand Watches <br> At Same Place!</h1>
                <p class="des">Buy Jaeger-LeCoultre, Audemars Piguet, Tudor, Omega, Rolex Watches at Best Selling Price and get Watches Within 2 - 3 Days. Limited Time Offer Available. </p>
                <a class="btn btn-outline-dark button" role="button" href="#product">See Products</a>
                <a class="btn btn-dark button" role="button" href="">Buy Now</a>
            </div>
            <div class="col-lg-6">
                <img class="front" src="img/front2.jpg" alt="Front Image">
                <img class="front" src="img/front3.jpg" alt="Front Image">
            </div>
        </div>
      </section>

      <section id="product">

        
        <?php
          $cnt = 0;
          foreach($result as $row)
          {
            $brandname = $row['brandname'];
            $bid = $row['id'];
            $imagename = $row['imagename'];
            if($cnt%3==0)
            {
              echo "<div class=\"row\">";
            }
            
        ?>

          <div class="card-space col-lg-4">
          <div class="card">
            <div class="card-img-top">
              <img class="title-img" src="/phpproj/admin/img/brandimgs/<?php echo $imagename ;?>" alt="">
            </div>
            <div class="card-body">
              <div class="card-title"><?php echo $brandname ; ?></div>
              <div class="card-text">
                <a class="btn btn-dark button" href="<?php echo "products.php?id=".$bid;?>">See More</a>
              </div>
            </div>
          </div>
          </div>

          <?php
            if($cnt%3==2)
            {
               echo "</div>";
            }
            $cnt++; 
          } 
          ?>
      </section>

      <!-- carousel-->
      <section id="carousel">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/c1.jpg" class="d-block w-100 custom" alt="...">
            </div>
            <div class="carousel-item">
              <img src="img/c2.jpg" class="d-block w-100 custom" alt="...">
            </div>
            <div class="carousel-item">
              <img src="img/c3.jpg" class="d-block w-100 custom" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </section>

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
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

</body>
</html>