<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="Mountainlogohead.png" />
    <title>Mountain</title>
  <style>
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
  </style>
  </head>
  <body>
<ul class="nav nav-fill text-white bg-dark sticky-top">
  <li class="nav-item">
 <a style="color:white;font-size:14px" class="navbar-brand" href="page1.php">
    <img src="Mountainlogo.png" width="30" height="30"class="d-inline-block align-center" href="page1.php">
    Mountain
  </a>
  </li>
  <li class="nav-item">
    <a style="color:white;font-size:14px"class="nav-link" href="Store.php">Store</a>
  </li>
  <li class="nav-item">
    <a style="color:white;font-size:14px"class="nav-link" href="Info.html">Info</a>
  </li>
  <li class="nav-item">
    <a style="color:white;font-size:14px"class="nav-link" href="support.html">Support</a>
  </li>
  <li class="nav-item">
    <a style="color:white;font-size:14px"class="nav-link" href="Contactus.html">Contact Us</a>
  </li>
  <li style="color:white;font-size:14px" class="nav-item dropdown">
    <a style="color:white;font-size:14px"class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php 
      if(!isset($_SESSION)){ 
        session_start(); 
    }
        if(isset($_SESSION["UFNAME"])){
            echo ($_SESSION['UFNAME']);
            echo('</a><div style="color:white;font-size:14px"class="dropdown-menu">
                  <a class="dropdown-item" href="logout.php">Log out</a>
                  
                </div>');

        }
    else{
        echo "Account";
        echo('</a><div style="color:white;font-size:14px"class="dropdown-menu">
              <a class="dropdown-item" href="signin.html">Log in</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="Signup.html">Sign up</a>
            </div>');
    }
?>
  </li>
</ul>
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <a href="video.html">
      <img src="mountainpic.jpg" alt="Mountain" width="1100" height="200">
      </a>
      <div class="carousel-caption">
        <h3>This is how we see the world</h3>
      </div>   
    </div>
    <div class="carousel-item">
      <a href="Store.php">
      <img src="firstshirt.jpg" alt="Store" width="1100" height="200">
      </a>
      <div class="carousel-caption">
        <h3>Store</h3>
        <p>Your imagination becomes reality</p>
      </div>   
    </div>
    <div class="carousel-item">
      <a href="Info.html">
      <img src="siteinfo.jpg" alt="Info" width="1100" height="200">
      </a>
      <div class="carousel-caption">
        <h3>Info</h3>
        <p>Our story</p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
</body>
</html>
