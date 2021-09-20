<?php

$conn = mysqli_connect("localhost", "root", "") 
  or die ("Connection error.");

$conn->select_db("store");
$query = "SELECT * FROM products";
$results = mysqli_query($conn,$query)
  or die(mysql_error($conn));

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="Mountainlogohead.png" />
    <title>Store</title>
  <style>
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }

.openBtn {
  background: #343A40;
  border: none;
  padding: 10px 15px;
  font-size: 20px;
  cursor: pointer;
}

.openBtn:hover {
  background: #bbb;
}

.overlay {
  height: 100%;
  width: 100%;
  display: none;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0, 0.9);
}

.overlay-content {
  position: relative;
  top: 46%;
  width: 80%;
  text-align: center;
  margin-top: 30px;
  margin: auto;
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
  cursor: pointer;
  color: white;
}

.overlay .closebtn:hover {
  color: #ccc;
}

.overlay input[type=text] {
  padding: 15px;
  font-size: 17px;
  border: none;
  float: left;
  width: 80%;
  background: white;
}

.overlay input[type=text]:hover {
  background: #f1f1f1;
}

.overlay button {
  float: left;
  width: 20%;
  padding: 15px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.overlay button:hover {
  background: #bbb;
}
</style>
  </head>
  <body>
<ul class="nav nav-fill text-white bg-dark sticky-top">
  <li class="nav-item mt-2 ">
 <a style="color:white;font-size:14px" class="navbar-brand" href="page1.php">
    <img src="Mountainlogo.png" width="30" height="30"class="d-inline-block align-center" href="page1.php">
    Mountain
  </a>
  </li>
  <li class="nav-item justify-content-between">
    <a style="color:white;font-size:14px"class="nav-link mt-2 " href="Store.php">Store</a>
  </li>
  <li class="nav-item">
    <a style="color:white;font-size:14px"class="nav-link mt-2 " href="Info.html">Info</a>
  </li>
  <li class="nav-item">
    <a style="color:white;font-size:14px"class="nav-link mt-2 " href="support.html">Support</a>
  </li>
<li style="color:white;font-size:14px" class="nav-item dropdown mt-2 ">
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
  <li class="nav-item">
<div id="myOverlay" class="overlay nav-item">
  <span class="closebtn" onclick="closeSearch()" title="Close Overlay"><i class="fas fa-times-circle"></i></span>
  <div class="overlay-content">
    <form action="/action_page.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search" ></i></button>
    </form>
  </div>
</div>
<li class="nav-item">
<button class="openBtn nav-item "  onclick="openSearch()"><i class="fa fa-search " style="color:white;" ></i></button>
  </li>
<script>
function openSearch() {
  document.getElementById("myOverlay").style.display = "block";
}

function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}
</script>
  <li class="nav-item mt-2  "> <a href="cart.php">
<i class="fas fa-shopping-bag fa-lg mt-2 " style="color:white;"></i> </a>
</li>
</ul>  

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Mountain Store</h1>
      
    </div>
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row">
    <?php

    // Show only Name, Price and Image
    while ($row = mysqli_fetch_array($results)) {
      extract($row);
    echo('<div class="col-md-4">
          <div class="card mb-4 shadow-sm">
          ');
         echo('<img src="'.$PIMG.'" height="100%" width="100%"<br>');
            echo('<div class="card-body">');
              echo('<div class="d-flex justify-content-between align-items-center">');
              echo('<p style="display:inline;" class="card-text">'.$PNAME."</p>");
              echo('<p >'.$PPRICE." LE.</p></div>");
              echo('<div class="d-flex justify-content-between align-items-center">');
                echo('<div class="btn-group">');
                  echo('<a class="btn btn-sm btn-outline-secondary" href="getprod.php?prodid='.$PNUM.'">View</a>');
                echo('</div>
                <small class="text-muted">'.$PVIEWS." views</small>");
              echo('</div>
                </div>
              </div>
            </div>');
    }
        ?>
      </div>
    </div>
  </div>

</main>

<footer class="text-muted">
  <div class="container">
    <p class="float-right">
      <a href="#">Back to top</a>
    </p>
    <p>This made by Abdelrahman Omar & Omar Ashraf</p>
  </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script></body>
</html>
