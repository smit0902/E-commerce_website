<?php
  session_start();
  include_once "config.php";
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

  if(isset($_GET['id'])&&!empty($_GET['id']))
  {
    $brand_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE brand_id =$brand_id AND status=1";
    $query=$con->prepare($sql);
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

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
    <link rel="stylesheet" href="css/product.css">

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
                <?php
                      foreach($result as $row){
                        $brandname = $row['brandname'];
                        $bid = $row['id'];
                  ?>
                  <li>
                    <a class="dropdown-item" href="<?php echo "products.php?id=".$bid;?>"> <?php echo $brandname ;?></a>
                  </li>
                  <li><hr class="dropdown-divider" /></li>
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

    <!-- Product -->
    <section>
      <?php
            $cnt = 0;
            foreach($result_products as $row)
            {
              $pid = $row['id'];
              $model_no = $row['model_no'];
              $price = $row['price'];
              $imagename = $row['image_name'];
              if($cnt%3==0)
              {
                echo "<div class=\"row\">";
              }
              
      ?>
            
            <div class="card-space col-lg-4">
                <div class="card">
                  <div class="card-img-top">
                    <center>
                    <img class="title-img" src="/phpproj/admin/img/productimgs/<?php echo $imagename ;?>" alt="">
                    </center>
                  </div>
                  <div class="card-body">
                    <div class="card-text">
                      <h3>Model No : <?php echo $model_no ;?></h3>
                      <h3>Price : <?php echo $price ;?>  &#8377;</h3> 

                      <?php if(isset($_SESSION['username'])){ ?>
                      <a class="btn btn-dark button" href="updatecart.php?act=add&pid=<?php echo $pid;?>"> Add to Cart</a>
                      <?php } ?>
               
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